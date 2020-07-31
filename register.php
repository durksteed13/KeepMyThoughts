<?php 
require_once 'init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array('username' => array('required' => true, 'min' => 2, 'max' => 20, 'unique' => 'users'), 'password' => array('required' => true, 'min' => 6), 'password_again' => array('required' => true, 'matches' => 'password'), 'name' => array('required' => true, 'min' => 2, 'max' => 50)));

		if($validation->passed()) {
			$user = new User();
			$salt = Hash::salt(32);
			try {
				$user->create(array('username' => Input::get('username'), 'password' => Hash::make(Input::get('password'), $salt), 'salt' => $salt, 'name' => Input::get('name'),));

				Session::flash('home', 'You have been registered and can now log in');
				Redirect::to('index.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<?php include 'html/header.html';?>
<body>
<?php include 'html/register.html';?>
</body>
<?php include 'html/footerFixed.html';?>
</html>
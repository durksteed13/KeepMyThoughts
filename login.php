<?php

require_once 'init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array('username' => array('required' => true), 'password' => array('required' => true)));

		if($validation->passed()) {
			$user = new User();

			$remember = (Input::get('remember') == 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login) {
				Redirect::to('index.php');
			} else {
				echo 'login failed';
			}
		} else {
			foreach ($validation->errors() as $error) {
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
<?php include 'html/login.html';?>
</body>
<?php include 'html/footerFixed.html';?>
</html>
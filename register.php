<?php require_once 'init.php';?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<div class="navigationHeader">
		<a href="index.html" id="logo">KEEP MY THOUGHTS</a>
		<nav id="topNav">
			<ul class="navigation">
					<li><a href="register.php">Sign Up</a></li>
					<li><a href="login.php">Log In</a></li>
			</ul>
		</nav>
	</div>
	<div class="errorWrapper">
	<?php 

		if(Input::exists()) {
			if(Token::check(Input::get('token'))) {
				$validate = new Validate();
				$validation = $validate->check($_POST, array('username' => array('required' => true, 'min' => 2, 'max' => 20, 'unique' => 'users'), 'password' => array('required' => true, 'min' => 6), 'confirmation' => array('required' => true, 'matches' => 'password'), 'name' => array('required' => true, 'min' => 2, 'max' => 50)));
				if($validation->passed()) {
					$user = new User();
					$salt = Hash::salt(32);
					try {
						$user->create(array('username' => Input::get('username'), 'password' => Hash::make(Input::get('password'), $salt), 'salt' => $salt, 'name' => Input::get('name'),));

						Redirect::to('index.php');
					} catch(Exception $e) {
						die($e->getMessage());
					}
				} else {
					$errorText = '';
					$x = 1;
					foreach($validation->errors() as $error) {
						$errorText .= $error . ', ';  
					}
					$errorText = substr($errorText, 0, -2);
					echo "<div class='error'>{$errorText}</div>";
				}
			}
		}
	?>
	</div>
	<?php include 'html/register.html';?>
</body>
</html>
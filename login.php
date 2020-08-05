<?php require_once 'init.php';?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="errorWrapper">
	<?php

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
						echo "<div class='error'>Incorrect username or password, please try again</div>";
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
<?php include 'html/login.html';?>
</body>
</html>
<?php

require_once 'init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->Check($_POST, array('password' => array('required' => true, 'min' => 6), 'new-password' => array('required' => true, 'min' => 6), 'confirmation-password' => array('required' => true, 'min' => 6, 'matches' => 'new-password')));

		if($validation->passed()) {
			if(Hash::make(Input::get('password'), $user->data()->salt) !== $user->data()->password) {
				echo "<div class='error'>Incorrect password, please try again</div>";

			} else {
				$salt = Hash::salt(32);
				$user->update(array('password' => Hash::make(Input::get('new-password'), $salt), 'salt' => $salt));

				// Session::flash('home', 'Your password has been changed');
				Redirect::to('index.php');
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

include 'html/changePassword.html';
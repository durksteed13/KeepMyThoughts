<?php

require_once 'init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->Check($_POST, array('name' => array('required' => true, 'min' => 2)));

		if($validation->passed()) {
			$user->update(array('name' => Input::get('name')));

			// Session::flash('home', 'Your name has been changed');
			Redirect::to('index.php');
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

include 'html/changeName.html';
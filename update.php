<?php

require_once 'init.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array('name' => array('required' => true, 'min' => 2, 'max' => 50)));
	}

	if($validate->passed()) {
		try {
			$user->update(array('name' => Input::get('name')));

			// Session::flash('home', 'Your profile has been updated');
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

include 'changeName.html';
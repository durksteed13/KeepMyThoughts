<?php

require_once 'init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {
			try {
				$user->createThought(array('username' => $user->data()->username, 'thought' => Input::get('thought'), 'date' => date('Y-m-d H:i:s')));
			} catch(Exception $e) {
				die($e->getMessage());
			}
		}
	}
	include 'html/user.html';
} else {;
	include 'html/index.html';
}
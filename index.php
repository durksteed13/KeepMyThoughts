<?php

require_once 'init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
	include 'html/user.html';
} else {;
	include 'html/index.html';
}
<?php

require_once 'init.php';

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}
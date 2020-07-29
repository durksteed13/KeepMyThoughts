<?php

require_once 'init.php';

if(Session::exists('success')) {
	echo Session::flash('success');
}
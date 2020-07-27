<?php

session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' =>'ruby.db.elephantsql.com',
		'username' => 'qgsmikpz',
		'password' => 'yLWbKfzlvzK0BrVq9vBCcpRjx21fEBFs',
		'db' => 'KeepMyThoughts'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user')
);

spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});

require_once '../scrubbing.php';
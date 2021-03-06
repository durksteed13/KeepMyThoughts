<?php

session_start();

$GLOBALS['config'] = array(
	'pgsql' => array(
		'host' =>'ruby.db.elephantsql.com',
		'username' => 'qgsmikpz',
		'password' => 'yLWbKfzlvzK0BrVq9vBCcpRjx21fEBFs',
		'db' => 'qgsmikpz'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token')
);

spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});

require_once 'scrubbing.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('session', array('hash', '=', $hash));

	if($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
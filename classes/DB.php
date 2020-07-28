<?php

class DB {
	private static $_instance = null;
	private $_pdo,
			$_query, 
			$_error = false, 
			$_results, 
			$_count = 0;

	private function __construct() {
		try {
			$this->_pdo = new PDO('pgsql:host=' . Config::get('pgsql/host') . ';dbname=' . Config::get('pgsql/db'), Config::get('pgsql/username'), Config::get('pgsql/password'));
			echo 'Connected';
		} catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
}
<?php

class Hash {

	public static function make($string, $salt = '') {
		return hash('sha256', $string . $salt);
	}

	public static function salt($length) {
		return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);;
	}

	public static function unique() {
		return self::make(uniqid());
	}
}
<?php

require_once '../init.php';

$user = DB::getInstance()->update('users', 2, array('password' => 'password'));
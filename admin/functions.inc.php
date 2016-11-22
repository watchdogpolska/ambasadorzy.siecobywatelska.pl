<?php

if(!file_exists("../db.inc.php"))header("Location: ../config.php");

include_once('../constants.inc.php');
include_once("../db.inc.php");

error_reporting(-1); //Comments these two lines to disable error reporting - NEED TO BE DONE IN PRODUCTION PHRASE!
ini_set('display_errors', 'On');

session_start();
session_regenerate_id();
if(!isset($_SESSION['csrf'])) csrf_gen();

//CSRF Token Generation & Validation
function csrf_gen() {
	$_SESSION['csrf'] = generateRandomString(12);
	return $_SESSION['csrf'];
}

function csrf_validate($given = "") {
	return $_SESSION['csrf'] == $given;
}

//Random string generation - code from http://stackoverflow.com/questions/4356289/php-random-string-generator (CC license)
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

?>

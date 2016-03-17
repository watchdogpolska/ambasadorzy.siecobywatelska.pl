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

if(isset($_SESSION['admin'])) { //security mechanism if user was removed when loggen in
	$f_link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
	$f_userzy = mysqli_query($f_link, "SELECT * from users WHERE usuniety = 0 AND idusers = ".mysqli_real_escape_string($f_link,$_SESSION['admin_id']));
	if($f_userzy->num_rows == 0) { header("location: login.php"); }

	$f_user = mysqli_fetch_array($f_userzy, MYSQLI_ASSOC);
	if(strtotime($f_user['lastchange']) < strtotime("1 month ago")) {
		$f_noloop = explode("/",debug_backtrace()[0]["file"]);
		if($f_noloop[count($f_noloop)-1] != "newpass.php") header('location: newpass.php');
	}


}

?>

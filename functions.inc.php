<?php

include_once('constants.inc.php');

if(!file_exists("db.inc.php")) header('Location: config.php'); // redirect to config when no base settings

error_reporting(-1); // Comments these two lines to disable error reporting - NEED TO BE DONE IN PRODUCTION PHRASE!
ini_set('display_errors', 'On');

session_start();
session_regenerate_id();
if(!isset($_SESSION['csrf'])) csrf_gen();

if(file_exists("db.inc.php") && file_exists("config.php")) unlink("config.php");

// Display basic website head section + body beginning
function showHead($subname, $header = "Ambasadorzy Jawności") {
	include ('parts/header.php');
}

// Function to show ending of each site
function showFooter() {
	include ('parts/footer.php');
}


// Global URL origin function from http://stackoverflow.com/questions/6768793/get-the-full-url-in-php (CC license)
function url_origin( $s, $use_forwarded_host = false )
{
	$ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
	$sp       = strtolower( $s['SERVER_PROTOCOL'] );
	$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
	$port     = $s['SERVER_PORT'];
	$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
	$host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	$host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
	return $protocol . '://' . $host;
}

// CSRF Token Generation & Validation
function csrf_gen() {
	$_SESSION['csrf'] = generateRandomString(12);
	return $_SESSION['csrf'];
}

function csrf_validate($given = "") {
	return $_SESSION['csrf'] == $given;
}

// Random string generation - code from
// http://stackoverflow.com/questions/4356289/php-random-string-generator (CC license)
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

//getting user's IP
function get_client_ip_env() {
	$ipaddress = '';
	if(getenv('REMOTE_ADDR')) {
		$ipaddress = getenv('REMOTE_ADDR');
	}else{
		$ipaddress = 'UNKNOWN';
	}

	return $ipaddress;
}
?>

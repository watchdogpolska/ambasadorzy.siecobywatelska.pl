<?php

include_once('constants.inc.php');

if(!file_exists("db.inc.php")) header('Location: config.php'); //redirect to config when no base settings

error_reporting(-1); //Comments these two lines to disable error reporting - NEED TO BE DONE IN PRODUCTION PHRASE!
ini_set('display_errors', 'On');

session_start();
session_regenerate_id();
if(!isset($_SESSION['csrf'])) csrf_gen();

if(file_exists("db.inc.php") && file_exists("config.php")) unlink("config.php");

// Display basic website head section + body beginning
function showHead($subname, $header = "Ambasadorzy Jawności") {

	?>

	<!DOCTYPE html>

	<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="<?php echo META_DESC; ?>">
	    <meta property="og:site_name" content="<?php echo PAGE_NAME; ?>"/>
	    <meta property="og:description" content="<?php echo META_DESC; ?>" />
	    <meta property="og:locale" content="pl_PL" />
	    <meta property="og:image" content="<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/img/facebook.jpg" />

	    <link rel="stylesheet" href="<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/css/reset.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="http://siecobywatelska.pl/font-wybory/MyFontsWebfontsKit.css">
	    <link rel="stylesheet" href="<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/css/cc-icons.min.css">
	    <link rel="stylesheet" href="<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/css/style.css">
	    <link rel='shortcut icon' type='image/x-icon' href='<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/favicon.ico' />
	    
	    <title>
	    <?php echo PAGE_NAME; if(!empty($subname)) echo " - ".$subname; ?>
	    </title>
	    </head>
	    <body style='font-family: "GloberRegular",Helvetica,Arial,sans-serif;'>
        	<div id="container">
		    <header>
		    <a href="http://siecobywatelska.pl"><img src="<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/img/watchdog.png" width="259" height="61" alt="Logo Watchdog"></a>
		        
		        <nav id="mainMenu">
		            <ul>
		            <a href="/"><li><i class="fa fa-home fa-2x"></i></li></a>
		            <a href="ambassadors.php"><li>Nasi Ambasadorzy</li></a>
		            <a href="withus.php"><li>Są z nami</li></a>
		            <a href="kancelarie.php"><li>Dla kancelarii</li></a>
		            <a href="download.php"><li>Do pobrania</li></a>
		            <a href="contact.php"><li>Kontakt</li></a>
		            </ul>
		        </nav>
		    </header> 
		    
		    <div id="contentContainer">
                	<h1><?php echo $header; ?></h1>
	    <?php


}

//Function to show ending of each site
function showFooter() {

	?>
		</div>
		<div class="clearfix"></div>
		    <footer>
			<div id="footHeaders" class="ffMedium">
			    <div class="col-md-4 text-left"><span>Autor</span></div>
			    <div class="col-md-4 text-center"><!-- FEAUTURE DISABLED <span>Partnerzy</span> --></div>
			    <div class="col-md-4 text-right"><span>Obserwuj nas na</span></div>
			</div>
			<div class="clearfix"></div>
			<div id="footData">             
			    <div id="contactInfo" class="col-md-4">
				<address>
				    <a href="http://siecobywatelska.pl">Sieć obywatelska - Watchdog Polska</a><br>
				    <a class="fooBar" href="http://www.google.com/recaptcha/mailhide/d?k=019SfyeYoOBXz-HBQPiC1dMw==&c=7t4uleBGHACWoT6pq8zcubkAl0UxUqb94jcrqtFq5N0="><span>biuro</span></a><br>
				    +48 22 844 73 55
				</address>
			    </div>
			    
			    <div class="col-md-4">
				<?php echo FOOTER_TEXT; ?>
			    </div>
			    
			    <div id="footSocialMedia" class="col-md-4 text-right">
				<a href="http://facebook.com/SiecObywatelskaWatchdogPolska"><i class="fa fa-facebook-official"></i></a>
				<a href="http://twitter.com/SiecObywatelska"><i class="fa fa-twitter"></i></a>
				<a href="https://www.youtube.com/channel/UC1d-Dkxrw5O9unN5FkB7inw"><i class="fa fa-youtube"></i></a>
				<a href="#"><i class="fa fa-rss"></i></a>
			    </div>
			</div>

			<div class="clearfix"></div>

			<div id="footBottom">
			    <div id="footBottomHR"></div>
			    
			    <nav id="footBottomLinks">
				<ul>
				    <li><a href="privacy.php">Polityka prywatności</a></li>
				</ul>
			    </nav>
			    
			    <div id="license">
				Materiały na stronie opublikowane są na licencji <a href="https://creativecommons.org/licenses/by-sa/3.0/pl/" title="Treść licencji CC BY-SA 3.0 PL">CC BY-SA 3.0 PL</a>
				<div><i class="cc cc-cc"></i><i class="cc cc-by"></i><i class="cc cc-sa"></i></div>
			    </div>
			</div>
			<div class="clearfix"></div>
		    </footer>
		</div>
		<div id="authorInfo">
		    <a href="<?php echo GITHUB_URL; ?>">Github</a>
		</div>
	    
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	    
	    </body>
	</html>
	<?php

}


//Global URL origin function from http://stackoverflow.com/questions/6768793/get-the-full-url-in-php (CC license)
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

//getting user's IP
function get_client_ip_env() {
	$ipaddress = '';
	if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';

	return $ipaddress;
}
?>

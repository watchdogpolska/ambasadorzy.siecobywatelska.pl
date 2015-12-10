<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

$failed = 0;

if(isset($_POST['sent']) && csrf_validate($_POST['csrf'])) {

	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2']; 

	if(strlen($pass1) < 8 || strlen($pass2) < 8 || $pass1 != $pass2) {
		$failed = 1;
	}
	else {
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		
		$pass1 = mysqli_real_escape_string($link, $pass1);
		$pass1 = hash("sha512", $pass1);
		
		mysqli_query($link, "UPDATE users SET password = '$pass1' WHERE idusers = {$_SESSION['admin_id']}");
		header("location: login.php");
	}
}

?>

<head>
<title>Zmiana hasła - adminpanel</title>
<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
<h2>Zmiana hasła</h2>
<hr/>
<br/>
Uzupełnij poniższy formularz, aby zmienić swoje hasło!<br/> Pamiętaj, że nowe hasło powinno mieć co najmniej 8 znaków!<br/>
Po wysłaniu formularza, zostaniesz wylogowany(a).<br/><br/>
<?php if($failed) echo "<span style='color: red'><b>Nie można zmienić hasła. Sprawdź, czy podane wartości są takie same i czy mają co najmniej 8 znaków!</b></span><br/><br/>"; ?>
<form action=newpass.php method=post>
<input type=hidden name=csrf value="<?php echo $_SESSION['csrf']; ?>"/>
Nowe hasło: <input type=password minlength=8 required name=pass1 /><br/><br/>
Powtórz hasło: <input type=password minlength=8 required name=pass2 /><br/><br/>
<input type=submit name=sent value="Dokonaj zmiany!" />
</form>
<br/>
<a href="index.php">Anuluj zmianę</a>
<br/>
<hr/>
<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</body>

<?php

include_once("functions.inc.php");

$failed = 0;

if(isset($_SESSION['admin'])) unset($_SESSION['admin']);

if(isset($_POST['sent']) && csrf_validate($_POST['csrf'])) {
	$login = $_POST['user'];
	$pass = $_POST['pass'];

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
	$login = mysqli_real_escape_string($link, $login);
	$pass = hash("sha512", $pass);
	$pass = mysqli_real_escape_string($link, $pass);

	$user = mysqli_query($link, "SELECT * FROM users WHERE usuniety = 0 AND login = '$login' AND password = '$pass' LIMIT 1");
	if($user->num_rows == 0) {
		$failed = 1;
	}
	else {
		$user = mysqli_fetch_row($user);
		$_SESSION['admin'] = 1;
		$_SESSION['admin_name'] = htmlspecialchars($user[3]);
		$_SESSION['admin_id'] = htmlspecialchars($user[0]);
		header('Location: index.php');
	}

}

?>
<head>
	<title>Logowanie - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center">
	<h2>Podaj dane logowania, aby uzyskać dostęp!</h2>
	<?php
	if($failed) {
		echo "<h3 style='color: red'>Podano nieprawidłowe dane logowania!</h3>";
	} ?>
	<div style="width: 60%; margin: 0 auto; font-size: 1.2em"><hr />
		<form action=login.php method=post>
			<input type=hidden name=csrf value="<?php echo $_SESSION['csrf']; ?>">
			User: <input type=text name=user required /><br/><br/>
			Hasło: <input type=password name=pass required /><br/><br/>
			<input type=submit value="Zaloguj się do Systemu!" name=sent />
			<hr/>
			<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
			<span style="font-size: 0.6em">System wewnętrzny Sieci Obywatelskiej Watchdog Polska. <br/>Próby uzyskania dostępu przez osoby nieuprawnione są zabronione.</span>
		</form>
	</div>
</body>

<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

$failed = 0;

if(isset($_POST['sent']) && csrf_validate($_POST['csrf'])) {

	$newname = $_POST['name'];
	$newlogin = $_POST['user'];
	$newpass = $_POST['pass'];

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

	$newname = mysqli_real_escape_string($link, $newname);
	$newlogin = mysqli_real_escape_string($link, $newlogin);

	$newpass = mysqli_real_escape_string($link, $newpass);
	if(strlen($newpass) < 8) $failed = 1;
	$newpass = hash("sha512", $newpass);

	$test = mysqli_query($link, "SELECT * FROM users WHERE login = '$newlogin'");
	if($test->num_rows > 0 || $failed) $failed = 1;

	else {

		mysqli_query($link, "INSERT INTO users (login, password, name) VALUES ('$newlogin','$newpass','$newname')");
		header("location: index.php?action=created");
	}
}

?>
<head>
	<title>Nowy użytkownik - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center">
	<h2>Wypełnij formularz, aby utworzyć nowe konto użytkownika!</h2>
	<?php if($failed) {
		echo "<h3 style='color: red'>Nie można utworzyć użytkownika. Sprawdź, czy login nie jest już w użyciu lub hasło nie jest krótsze niż 8 znaków.</h3>";
	} ?>
	<div style="width: 60%; margin: 0 auto; font-size: 1.2em"><hr />
		<form action=new.php method=post>
			<input type=hidden name=csrf value="<?php echo $_SESSION['csrf']; ?>">
			Login: <input type=text name=user required /><br/><br/>
			Hasło: <input type=password name=pass required /><br/><br/>
			Nazwa (imię): <input type=text name=name required /><br/><br/>
			<input type=submit value="Utwórz użytkownika!" name=sent />
			<br/><br/>
			<a href="index.php">Anuluj operację!</a>
			<hr/>
			<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
		</form>
	</div>
</body>

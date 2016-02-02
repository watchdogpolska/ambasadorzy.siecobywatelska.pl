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

	if(strtoupper($pass1) == $pass1 || strtolower($pass1) == $pass1 || !preg_match("[\W]", $pass1)) {
		$failed = 1;
	}

	if(!$failed) {
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

		$pass1 = mysqli_real_escape_string($link, $pass1);
		$pass1 = hash("sha512", $pass1);

		$test = mysqli_query($link, "SELECT * FROM users WHERE idusers = {$_SESSION['admin_id']}");
		$test = mysqli_fetch_array($test,MYSQLI_ASSOC);

		if($pass1 == $test['password']) $failed = 1;

		else {
			mysqli_query($link, "UPDATE users SET password = '$pass1', lastchange='".date("Y-m-d")."' WHERE idusers = {$_SESSION['admin_id']}");
			header("location: login.php");
		}
	}
}

?>

<head>
	<title>Zmiana hasła - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Zmiana hasła</h2>
		<hr/>
		<p>Uzupełnij poniższy formularz, aby zmienić swoje hasło!</p>
		<p>Pamiętaj, że nowe hasło powinno mieć co najmniej 8 znaków, zawierać małe, duże litery, znaki specjalne oraz cyfry!</p>
		<p>Musi ono być różne od poprzedniego!</p>
		<p>Po wysłaniu formularza, zostaniesz wylogowany(a).</p>
		<p>(Istnieje prawny wymóg zmiany hasła co 30 dni)</p>
		<?php if($failed) {
		?>
			<div class="alert alert-danger" role="alert">Nie można zmienić hasła. Sprawdź, czy podane wartości są takie same i czy mają co najmniej 8 znaków oraz spełniają wymogi!</div>
		<?php
		}
		?>
			<form action="newpass.php" method="post">
				<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>"/>
				<div class="form-group">
					<label for="field_pass1" class="col-sm-4 control-label">Nowe hasło: <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
					<div class="col-sm-8">
						<input type="text" name="pass1" required minlength="8" class="form-control" id="field_pass1">
					</div>
				</div>
				<div class="form-group">
					<label for="field_pass2" class="col-sm-4 control-label">Powtórz hasło:<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
					<div class="col-sm-8">
						<input type="text" name="pass2" required minlength="8" class="form-control" id="field_pass2">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" name="sent" class="btn btn-primary">Dokonaj zmiany!</button>
					</div>
				</div>
			</form>
			<br/>
			<a href="index.php">Anuluj zmianę</a>
			<br/>
			<hr/>
			<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
	</div>
	</body>

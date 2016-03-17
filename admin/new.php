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
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Tworzenie użytkownika</h2>
		<p class="lead">Wypełnij formularz, aby utworzyć nowe konto użytkownika!</p>
		<?php if($failed) {
		?>
			<div class="alert alert-danger" role="alert">Nie można utworzyć użytkownika. Sprawdź, czy login nie jest już w użyciu lub hasło nie jest krótsze niż 8 znaków.</div>
		<?php
		}
		?>
		<hr />
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
				<form action="new.php" method="post" class="form-horizontal" role="form">
					<input type=hidden name=csrf value="<?php echo $_SESSION['csrf']; ?>">
					<div class="form-group">
						<label for="field_user" class="col-sm-4 control-label">Login: </label>
						<div class="col-sm-8">
							<input type="text" name="user" required class="form-control" id="field_user">
						</div>
					</div>
					<div class="form-group">
						<label for="field_password" class="col-sm-4 control-label">Hasło: </label>
						<div class="col-sm-8">
							<input type="password" name="pass" required class="form-control" id="field_password">
						</div>
					</div>
					<div class="form-group">
						<label for="field_name" class="col-sm-4 control-label">Nazwa (imię): </label>
						<div class="col-sm-8">
							<input type="text" name="name" required class="form-control" id="field_name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<button type="submit" class="btn btn-primary" name="sent">Utwórz użytkownika!</button>
							<a href="index.php" class="btn btn-default">Anuluj operację!</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<hr/>
		<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
	</div>
</body>

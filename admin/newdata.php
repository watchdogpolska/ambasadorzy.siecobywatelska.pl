<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

if(isset($_POST['sent']) && csrf_validate($_POST['csrf'])) {

	$newname = $_POST['name'];

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

	$newname = mysqli_real_escape_string($link, $newname);

	mysqli_query($link, "UPDATE users SET name = '$newname' WHERE idusers = {$_SESSION['admin_id']}");
	header("location: login.php");
}

?>

<head>
	<title>Zmiana danych - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Zmiana danych</h2>
		<p>Uzupełnij poniższy formularz, aby zmienić swoje dane!</p>
		<p>Po wysłaniu formularza, zostaniesz wylogowany(a).</p>
		<form action="newdata.php" method="POST" class="form-horizontal" role="form">
			<input type=hidden name=csrf value="<?php echo $_SESSION['csrf']; ?>"/>
			<div class="form-group">
				<label for="field_name" class="col-sm-4 control-label">Nowe imię i nazwisko (nazwa): </label>
				<div class="col-sm-8">
					<input type="text" name="name" required class="control-label" id="field_name">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-8 col-sm-offset-4">
					<button type="submit" class="btn btn-primary" name="sent">Dokonaj zmiany!</button>
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

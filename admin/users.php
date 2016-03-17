<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

$errormsg = "";

if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	if($id != $_SESSION['admin_id']) {
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$user = mysqli_query($link, "SELECT * FROM users WHERE usuniety = 0 AND idusers = ".mysqli_real_escape_string($link, $id));
		if($user->num_rows == 0) $errormsg = "Użytkownik o zadanym ID nie istnieje. Nie można usunąć.";
		else {
			mysqli_query($link, "UPDATE users SET usuniety = 1 WHERE idusers = ".mysqli_real_escape_string($link, $id));
			$errormsg = "Użytkownik #".htmlspecialchars($id)." został pomyślnie usunięty!";
		}
	}
	else $errormsg = "Nie możesz usunąć swojego konta użytkownika";

}
?>

<head>
	<title>Użytkownicy - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Lista użytkowników</h2><hr/>
		<?php
		if(!empty($errormsg)) {
		?>
			<div class="alert alert-success" role="alert"><?php echo $errormsg; ?></div>
		<?php
		}
		?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nick</th>
					<th>Imię i nazwisko</th>
					<th>Akcje</th>
				</tr>
			</thead>
			<?php
			$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
			$userzy = mysqli_query($link, "SELECT * from users");
			while($user = mysqli_fetch_array($userzy, MYSQLI_ASSOC)) {
				$nick = htmlspecialchars($user['login']);
				$name = htmlspecialchars($user['name']);
				$id = htmlspecialchars($user['idusers']);
				?>
				<tr>
					<td><?php echo $nick; ?></td>
					<td><?php echo $nick; ?></td>
					<td>
					<?php
					if($id != $_SESSION['admin_id']){
						if(!$user['usuniety']) {
							echo "<button value=\"Usuń!\" onclick=\"document.location.href = 'users.php?remove=$id';\" class=\"btn btn-danger\">Usuń</button>";
						}else {
							echo "Usunięty";
						}
					}
					?>
					</td>

				</tr>
			<?php
			}
			?>
		</table>
		<br/>
		<a href="login.php">Wyloguj się</a><br/>
		<a href="new.php">Nowy użytkownik</a><br/>
		<a href="index.php">Strona główna</a><br/>
		<br/>
		<hr/>
		<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
	</div>
</body>

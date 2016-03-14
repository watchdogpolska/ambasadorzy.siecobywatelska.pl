<?php

include_once("functions.inc.php");

$failed = 0;

if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}

if (isset($_POST['sent']) && csrf_validate($_POST['csrf'])) {
    $login = $_POST['user'];
    $pass = $_POST['pass'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE);
    $login = mysqli_real_escape_string($link, $login);
    $pass = hash("sha512", $pass);
    $pass = mysqli_real_escape_string($link, $pass);

    $user = mysqli_query($link, "SELECT * FROM users WHERE usuniety = 0 AND login = '$login' AND password = '$pass' LIMIT 1");
    if ($user->num_rows == 0) {
        $failed = 1;
    } else {
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
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
<div class="row">
	<div class="col xs-12 col-md-8 col-md-push-2 col-lg-6 col-lg-push-3">
		<div class="well">
			<h2>Logowanie</h2>
			<p>Podaj dane logowania, aby uzyskać dostęp!</p>
			<?php
            if ($failed) {
                <div class="alert alert-success" role="alert">Podano nieprawidłowe dane logowania!</div>
                <?php
            }
            ?>
			<form action="login.php" method="post">
				<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
				<div class="form-group">
					<label for="field_user">Login:</label>
					<input type="text" name="user" required="" class="form-control" id="field_user">
				</div>
				<div class="form-group">
					<label for="field_pass">Hasło:</label>
					<input type="password" name="pass" required="" class="form-control" id="field_pass">
				</div>
				<button type="submit" name="sent" class="btn btn-primary">Zaloguj się</button>
			</form>
		</div>
	</div>
</div>
		<hr/>
		<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
		<span style="font-size: 0.6em">System wewnętrzny Sieci Obywatelskiej Watchdog Polska. <br/>Próby uzyskania dostępu przez osoby nieuprawnione są zabronione.</span>
	</div>
</body>

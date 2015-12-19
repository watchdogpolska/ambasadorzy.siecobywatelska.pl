<?php

$toasts = array();
if(file_exists("db.inc.php")) header('Location: index.php'); //prevent reconfiguration

if(isset($_POST['sent'])) {
	$login = isset($_POST['user']) ? $_POST['user'] : 'root';
	$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
	$db = isset($_POST['base']) ? $_POST['base'] : 'ambasadorzy_siecobywatelska_pl';
	$host = isset($_POST['host']) ? $_POST['host'] : '127.0.0.1';
	
	$link = mysqli_connect($host, $login, $pass, $db);
	if(mysqli_connect_errno()) {
		$toasts[]  = '<div class="alert alert-danger" role="alert">Can\'t connect to DB('.mysqli_connect_errno().')'. mysqli_connect_error().'</div>';
	}
	else {
		mysqli_query($link,"CREATE TABLE IF NOT EXISTS `users` (`idusers` INT NOT NULL AUTO_INCREMENT,`login` VARCHAR(45) NOT NULL,`password` VARCHAR(128) NOT NULL,`name` VARCHAR(60) NOT NULL, `usuniety` TINYINT(1) NOT NULL DEFAULT 0, `lastchange` DATE NOT NULL, PRIMARY KEY (`idusers`)) ENGINE = InnoDB;");
		mysqli_query($link,"CREATE TABLE IF NOT EXISTS `ambassadors` (`idambassadors` INT NOT NULL AUTO_INCREMENT,`imie` VARCHAR(45) NOT NULL,`nazwisko` VARCHAR(45) NOT NULL,`email` VARCHAR(60) NOT NULL,`miasto` VARCHAR(45) NOT NULL,`telefon` VARCHAR(15) NOT NULL,`zawod` VARCHAR(200) NOT NULL,`dlaczego` TEXT NOT NULL DEFAULT '',`adres` VARCHAR(200) NULL,`zdjecie` TEXT NULL,`zaakceptowany` TINYINT(1) NOT NULL DEFAULT 0,`odrzucony` TINYINT(1) NOT NULL,`data` TIMESTAMP NOT NULL DEFAULT NOW(),`ip` TEXT NOT NULL, PRIMARY KEY (`idambassadors`)) ENGINE = InnoDB;");
		mysqli_query($link,"CREATE TABLE IF NOT EXISTS `orgs` (`idorgs` INT NOT NULL AUTO_INCREMENT, `nazwa` VARCHAR(128) NOT NULL, `miasto` VARCHAR(45) NOT NULL, `telefon` VARCHAR(15) NOT NULL, `email` VARCHAR(60) NOT NULL, `specjalizacja` TEXT NOT NULL, `strona` VARCHAR(60) NULL, `adres` VARCHAR(200) NOT NULL, `logo` VARCHAR(100) NULL, PRIMARY KEY (`idorgs`)) ENGINE = InnoDB");		
		mysqli_query($link,"CREATE TABLE IF NOT EXISTS `famous` (`idfamous` INT NOT NULL AUTO_INCREMENT, `name` VARCHAR(60) NOT NULL, `desc` TEXT NOT NULL, `videolink` VARCHAR(90) NOT NULL, PRIMARY KEY (`idfamous`)) ENGINE = InnoDB");
		mysqli_query($link,"INSERT INTO `users` (`idusers`, `login`, `password`, `name`) VALUES (NULL, 'root', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Administrator');");
		
		$content = "<?php define('DB_HOST','".$host."');\r\n";
		$content .= "define('DB_USER','".$login."');\r\n";
		$content .= "define('DB_PASS','".$pass."');\r\n";
		$content .= "define('DB_BASE','".$db."'); ?>";
		
		file_put_contents("db.inc.php", $content);
		
		header("Location: index.php");
	}
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfiguracja ambasadorzy.siecobywatelska.pl</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <img src="/img/watchdog.png" alt="" class="pull-right">
        <h1>Installer</h1>
        <?php
        foreach ($toasts as $toast) {
            echo $toast;
        }
        ?>
        To install the application, please fill out the form: 
        <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <form action="config.php" class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="input_user" class="col-sm-4 control-label">User</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="input_user" name="user" placeholder="root" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_password" class="col-sm-4 control-label">Pasword</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="input_password" name="pass" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_dbname" class="col-sm-4 control-label">Database name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="input_dbname" name="base" placeholder="ambasadorzy_siecobywatelska_pl" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_dbhost" class="col-sm-4 control-label">Database address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="input_dbhost" name="host" placeholder="127.0.0.1" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary" name="sent">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

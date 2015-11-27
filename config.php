<?php

if(file_exists("db.inc")) header('Location: index.php'); //prevent reconfiguration

if(isset($_POST['sent'])) {
	$login = $_POST['user'];
	$pass = $_POST['pass'];
	$db = $_POST['base'];
	$host = $_POST['host'];
	
	$link = mysqli_connect($host,$login,$pass,$db);
	if(mysqli_connect_errno()) {
		echo "<span style='color: red'>Nie można połączyć się z bazą danych! (Can't connect to DB)</span><br/>";
	}
	else {
		mysqli_query($link,"CREATE TABLE IF NOT EXISTS `users` (`idusers` INT NOT NULL AUTO_INCREMENT,`login` VARCHAR(45) NOT NULL,`password` VARCHAR(128) NOT NULL,`name` VARCHAR(60) NOT NULL,PRIMARY KEY (`idusers`)) ENGINE = InnoDB;");
		mysqli_query($link, "CREATE TABLE IF NOT EXISTS `ambassadors` (`idambassadors` INT NOT NULL AUTO_INCREMENT,`imie` VARCHAR(45) NOT NULL,`nazwisko` VARCHAR(45) NOT NULL,`email` VARCHAR(60) NOT NULL,`miasto` VARCHAR(45) NOT NULL,`telefon` VARCHAR(15) NOT NULL,`zawod` VARCHAR(200) NOT NULL,`dlaczego` TEXT NOT NULL DEFAULT '',`adres` VARCHAR(200) NULL,`zdjecie` BLOB NULL,`zaakceptowany` TINYINT(1) NOT NULL DEFAULT 0,`odrzucony` TINYINT(1) NOT NULL,`data` TIMESTAMP NOT NULL DEFAULT NOW(), PRIMARY KEY (`idambassadors`)) ENGINE = InnoDB;");
		
		$content = "<?php define('DB_HOST','".$host."');\r\n";
		$content .= "define('DB_USER','".$login."');\r\n";
		$content .= "define('DB_PASS','".$pass."');\r\n";
		$content .= "define('DB_BASE','".$db."'); ?>";
		
		file_put_contents("db.inc", $content);
		
		header("Location: index.php");
	}
}


?>

Podaj poniższe dane, aby skonfigurować (fill the form below to configure): <br/>
<form action=config.php method=post>
User: <input type=text name=user required />
<br/>
Password: <input type=password name=pass required />
<br/>
DB Name: <input type=text name=base required />
<br/>
Host: <input type=text name=host required />
<br/>
<input type=submit name=sent value="Konfiguruj/configure!" />
</form>

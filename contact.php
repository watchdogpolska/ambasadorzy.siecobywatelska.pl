<?php

include_once('functions.inc');
showHead("Kontakt");

if(isset($_POST['submit'])) {

	if(csrf_validate($_POST['csrfprotection'])) {

		$topic = htmlspecialchars($_POST['topic']);
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$text = htmlspecialchars($_POST['msg']);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: Biuro Watchdog <'.NET_MAIL.'>' . "\r\n";
		$headers .= "From: $name <$email>" . "\r\n";
	
		mail(NET_MAIL, "Wiadomość z formularza kontaktowego Ambasadorów Jawności", "Temat: <br/>".$topic."<br/><br/>Treść wiadomości: <br/>".$text."<br/><br/>IP: ".htmlspecialchars(get_client_ip_env()), $headers);
	}
}

?>

<div id="contactInfoBlock">
    <div id="contactInfo1" class="block grayBlock">
        <div class="blockFoldHold">
            <div class="blockFold"></div>
            <div class="blockFoldClear"></div>
        </div>
        <div class="blockContent">
            <h2>Kontakt</h2>
            <h3>Koordynator projektu</h3>
            <address>
                <i class="fa fa-envelope fa-fw"></i> 
                <a class="fooBar" href="http://www.google.com/recaptcha/mailhide/d?k=019SfyeYoOBXz-HBQPiC1dMw==&amp;c=n2luU5mPbHzPitgNjd8j2XKcA0jsnCKbdwK9fCkXEJk="><span>adam.sawicki</span></a>
                <br>
                <i class="fa fa-phone fa-fw"></i> 22 844 73 55 
            </address>
            <h3>Nasze biuro</h3>
            <address>
                <i class="fa fa-envelope fa-fw"></i> 
                <a class="fooBar" href="http://www.google.com/recaptcha/mailhide/d?k=019SfyeYoOBXz-HBQPiC1dMw==&amp;c=7t4uleBGHACWoT6pq8zcubkAl0UxUqb94jcrqtFq5N0="><span>biuro</span></a>
                <br>
                <i class="fa fa-phone fa-fw"></i> 22 844 73 55 
            </address>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="contactInfo2" class="block grayBlock">
        <div class="blockFoldHold">
            <div class="blockFold"></div>
            <div class="blockFoldClear"></div>
        </div>
        <div class="blockContent">
            <h2>Adres</h2>
            <address>
                <b>Sieć obywatelska - Watchdog Polska</b>
                <br>
                ul. Ursynowska 22/2
                <br>
                02-605 Warszawa 
            </address>
        </div>
    </div>
</div>
<div id="contactForm" class="block redBlock">
    <div class="blockFoldHold">
        <div class="blockFold"></div>
        <div class="blockFoldClear"></div>
    </div>
    <div class="blockContent">
        <h2>Skontaktuj się z nami</h2>
      <?php if(isset($_POST['submit'])) {
      	echo "Dziękujemy! Twoja wiadomość została przesłana!";
      }
      else {  ?>
        <div id="reqNote">Pola oznaczone gwiazdką (*) są wymagane</div>
        <br/>
        <form method=POST action=contact.php>
        	<input type=hidden name=csrfprotection value="<?php echo $_SESSION['csrf']; ?>"/>
        	Twój email *<br/><input class="textinput textInput form-control" maxlength="150" name="email" type="text" required /><br/>
        	Imię (i nazwisko) *<br/><input class="textinput textInput form-control" maxlength="150" name="name" type="text" required /><br/>
        	Temat *<br/><input class="textinput textInput form-control" maxlength="150" name="topic" type="text" required /><br/>
        	Wiadomość *<br/><textarea class="textinput textInput form-control" name=msg required></textarea><br/>
        	<div class="form-actions"><input type="submit" name="submit" value="Wyślij" class="btn btn-primary btn-lg btn-block" id="submit-id-submit"> </div>
        </form>
        <?php } ?>
    </div>
</div>

<?php

showFooter();

?>
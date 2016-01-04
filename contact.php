<?php

include_once('functions.inc.php');
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
<div class="row">
	<div class="col-md-4 col-md-push-8">
		<div id="contactInfoBlock">
			<div id="contactInfo1" class="block grayBlock">
				<div class="blockContent">
					<h2>Kontakt</h2>
					<h3>Koordynator projektu</h3>
					<address>
						<i class="fa fa-envelope fa-fw"></i>
						<a class="fooBar" href="http://www.google.com/recaptcha/mailhide/d?k=0133IYp4KK6_WtYnLoma6bsg==&c=xkFwb7Xs0uxvl9Kz56Fp9GHpm9kZRxoc6SI4Du0zXyGFIJpvo_XHt-_ksaeX7i92"><span>roksana.maslankiewicz</span></a>
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
			<div id="contactInfo2" class="block grayBlock">
				<div class="blockContent">
					<h2>Adres</h2>
					<address>
						<b>Sieć obywatelska - Watchdog Polska</b><br>
						ul. Ursynowska 22/2<br>
						02-605 Warszawa
					</address>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-md-pull-4">
		<div id="contactForm" class="block grayBlock">
			<div class="blockContent">
				<h2>Skontaktuj się z nami</h2>
				<?php if(isset($_POST['submit'])) {
					echo "Dziękujemy! Twoja wiadomość została przesłana!";
				}
				else {  ?>
				<div id="reqNote">Pola oznaczone gwiazdką (*) są wymagane</div>
				<br/>
				<form method=POST action=contact.php>
					<input type="hidden" name="csrfprotection" value="<?php echo $_SESSION['csrf']; ?>"/>
					<div class="form-group">
						<label for="">Twój email *</label>
						<input class="textinput textInput form-control" maxlength="150" name="email" type="text" required />
					</div>
					<div class="form-group">
						<label for="">Imię (i nazwisko) *</label>
						<input class="textinput textInput form-control" maxlength="150" name="name" type="text" required />
					</div>
					<div class="form-group">
						<label for="">Temat *</label>
						<input class="textinput textInput form-control" maxlength="150" name="topic" type="text" required />
					</div>
					<div class="form-group">
						<label for="">Wiadomość *</label>
						<textarea class="textinput textInput form-control" name=msg required></textarea>
					</div>
					<div class="form-actions"><input type="submit" name="submit" value="Wyślij" class="btn btn-primary btn-lg btn-block" id="submit-id-submit"> </div>
				</form>
				<?php } ?>
			</div>
		</div>
	</div>
</div>



<?php

showFooter();

?>

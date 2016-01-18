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
	<div class="col-md-6 col-md-push-6 col-lg-4 col-lg-push-8 ">
		<div id="contactInfoBlock">
			<div id="contactInfo1" class="block grayBlock">
				<div class="blockContent" style="word-wrap: break-word;">
					<h2>Kontakt</h2>
					<h3>Koordynatorka projektu</h3>
					<img src="/static/images/roksana.jpg" alt="Roksana Maślankiewicz" class="blockImage">
					<div id="hcard-Roksana-Maślankiewicz" class="vcard">
						<span class="fn">Roksana Maślankiewicz</span>
						<div class="contact-field">
							<div class="contact-field-cel">
								<i class="fa fa-envelope fa-fw"></i>
							</div>
							<div class="contact-field-cell">
								<a class="email" href="mailto:roksana.maslankiewicz@siecobywatelska.pl">roksana.maslankiewicz@siecobywatelska.pl</a>
							</div>
						</div>
						<div class="contact-field">
							<div class="contact-field-cell">
								<i class="fa fa-phone fa-fw"></i>
							</div>
							<div class="contact-field-cell">
								<div class="tel">22 844 73 55</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="contactInfo2" class="block grayBlock">
				<div class="blockContent">
					<h2>Adres</h2>
					<div id="org-address" class="vcard">
						<div class="org fn n">Sieć Obywatelska Watchdog Polska</div>
						<div class="adr">
							<div class="street-address">ul. Ursynowska 22/2</div>
							<span class="locality">Warszawa</span>, <span class="postal-code">02-605</span>
							<span class="country-name">Polska</span>
						</div>
						<div class="contact-field">
							<div class="contact-field-cell">
								<i class="fa fa-envelope fa-fw"></i>
							</div>
							<div class="contact-field-cell">
								<a class="email" href="mailto:biuro@siecobywatelska.pl">biuro@siecobywatelska.pl</a></div>
							</div>
						<div class="contact-field">
							<div class="contact-field-cell">
								<i class="fa fa-phone fa-fw" title="Numer telefonu"></i>
							</div>
							<div class="contact-field-cell">
								<div class="tel"> 22 844 73 55</div>
							</div>
						</div>
						<a href="http://siecobywatelska.pl" class="url">www.siecobywatelska.pl</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-md-pull-6 col-lg-8 col-lg-pull-4 ">
		<div id="contactForm" class="block grayBlock">
			<div class="blockContent">
				<h2>Skontaktuj się z nami</h2>
				<?php if(isset($_POST['submit'])) {
					echo "Dziękujemy! Twoja wiadomość została przesłana!";
				}
				else {  ?>
				<br/>
				<form method=POST action=contact.php>
					<input type="hidden" name="csrfprotection" value="<?php echo $_SESSION['csrf']; ?>"/>
					<div class="form-group">
						<label for="">Twój email <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input class="textinput textInput form-control" maxlength="150" name="email" type="text" required />
					</div>
					<div class="form-group">
						<label for="">Imię (i nazwisko) <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input class="textinput textInput form-control" maxlength="150" name="name" type="text" required />
					</div>
					<div class="form-group">
						<label for="">Temat <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input class="textinput textInput form-control" maxlength="150" name="topic" type="text" required />
					</div>
					<div class="form-group">
						<label for="">Wiadomość <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
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

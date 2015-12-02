<?php

include_once('functions.inc');
include_once('db.inc');

if(!isset($_SESSION['registered'])) {
	//header('Location: index.php');
}

showHead("Zarejestrowano", "Dziękujemy!");

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="signFormBlock" class="block redBlock">
	<div class="blockFoldHold">
	<div class="blockFold"></div>
	<div class="blockFoldClear"></div>
</div>

<div class="blockContent">
<h2>Dziękujemy za rejestrację!</h2>
<p>Dziękujemy za przesłanie zgłoszenia i chęć dołączenia do  Ambasadorów/Ambasadorek jawności!</p> 
<p>Wkrótce skontaktuje się z Tobą mailowo koordynator programu.</p>
<p>Prosimy, podziel się informacją o programie ze znajomymi i przekaż im adres tej strony.</p>
<p><div class="fb-share-button" data-href="https://ambasadorzy.siecobywatelska.pl" data-layout="button_count"></div></p>
</div>



<?php

showFooter();

?>

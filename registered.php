<?php

include_once('functions.inc.php');
include_once('db.inc.php');

if(!isset($_SESSION['registered'])) {
//header('Location: index.php');
}

showHead("Zarejestrowano", "Rejestracja ukończona!");

?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.5";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div id="signFormBlock" class="block redBlock">

	<div class="blockContent">
		<img style="float: right; height: 10em" class="img-responsive" src="/static/images/jawnosc.jpg" alt="Jawność">
		<p>Dziękujemy za przesłanie zgłoszenia i chęć dołączenia do  Ambasadorów/Ambasadorek Jawności!</p>
		<p>Wkrótce skontaktuje się z Tobą mailowo koordynator programu.</p>
		<p>Prosimy, podziel się informacją o programie ze znajomymi i przekaż im adres tej strony.</p>
		<div class="fb-share-button" data-href="https://ambasadorzy.siecobywatelska.pl" data-layout="button_count"></div>
		<a href="https://twitter.com/share" class="twitter-share-button"{count} data-url="http://ambasadorzy.siecobywatelska.pl" data-text="Zostałem Ambasadorem Jawności!" data-related="siecobywatelska" data-hashtags="jawność">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
</div>


<?php

showFooter();

?>

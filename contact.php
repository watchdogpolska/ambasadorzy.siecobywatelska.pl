<?php

include_once('functions.inc');
showHead("Kontakt");

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
        
        <div id="reqNote">Pola oznaczone gwiazdką (*) są wymagane</div>
        
        <form method=POST action=contact.php>
        	<input type=hidden name=csrfprotection value="<?php echo $_SESSION['csrf']; ?>"/>
        
        </form>
        
    </div>
</div>

<?php

showFooter();

?>

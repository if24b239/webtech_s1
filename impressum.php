<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "FAQ und Impressum"; include 'php_inserts\head.php' ?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
<div class="halfScreen">
    <section class="halfScreenChild">
        <h1>Impressum</h1>
                    
            <p class="p-wholeContainer">Hotel Maran-Gampenrieder GmbH.</p>
            <p class="p-wholeContainer">Hotelbetrieb</p>
            <p class="p-wholeContainer">UID: ATU 12345678 </p>
            <p class="p-wholeContainer">FN: 123456a</p>
            <p class="p-wholeContainer">FB-Gericht: Musterstadt</p>
            <p class="p-wholeContainer">Sitz: 1234 Musterstadt</p>
            <p class="p-wholeContainer">Musterstraße 3 | Austria</p>
            <p class="p-wholeContainer"> </p>
            <p class="p-wholeContainer">office@hotel-maran-gampenrieder.at</p>
            <p class="p-wholeContainer">+43 123456789</p>
            <p class="p-wholeContainer"> </p>
            <p class="p-wholeContainer">Mitgliedschaft(en) bei der Wirtschaftskammerorganisation</p>
            <a  class="p-wholeContainer" href="https://www.ris.bka.gv.at/GeltendeFassung.wxe?Abfrage=Bundesnormen&Gesetzesnummer=10007517">Berufsrecht</a>
            <p class="p-wholeContainer">Bezirkshauptstadt Musterstadt </p>
            <p class="p-wholeContainer">spezielle Berufsbezeichnung</p>
            <p class="p-wholeContainer">Staat, in dem diese Berufsbezeichnung verliehen wurde</p>
            <a  class="p-wholeContainer" href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home.chooseLanguage">OnlineStreitbeilegungsplattform der EU</a>
            <p class="p-wholeContainer"> </p>
    </section>
    
    <section class="halfScreenChild" >
        <h2 class="p-wholeContainer">Mitglieder der Hotelverwaltung</h2>
        
        <figure class="impressum">
            <img src="bild_lena.png" alt="Mitglied der Hotelverwaltung Lena Gampenrieder">
            <figcaption>Lena Gampenrieder</figcaption>
        </figure>

        <figure class="impressum">
            <img src="bild_marold.png" alt="Mitglied der Hotelverwaltung Marold Meran">
            <figcaption>Marold Meran</figcaption>
        </figure>

    </section>
</div>
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
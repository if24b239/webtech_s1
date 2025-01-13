<?php session_start(); ?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Startseite"; include 'php_inserts\head.php';

?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section class="index">
        <section class="section-mainLeft">

                <img class="img-index col-5-index" src="pictures/tavernInside.jpg" alt="Ein Bild unseres Frühstücksbereichs">

            <div class="col-7-index">
                <h2 class="h2-index">Willkommen in unserer Taverne</h2>
                <br>
                <br>
                <div class="text-inside-section">
                <p class="p-index">Beginnen Sie Ihren Morgen mit einem herzhaften Frühstück, das keine Wünsche offenlässt. 
                    In unserer Taverne bieten wir Ihnen eine Auswahl an frischen Zutaten, wie Spiegelei von
                    freilaufenden Basilisken, süße Aufstriche und frisch gepresste Säfte, 
                    die den Tag mit einem frischen und belebenden Geschmack starten lassen.</p>
                </div>    
            </div>
        </section>

        <section class="section-mainRight">
            
                <img class="img-index col-5-index" src="pictures/garden.jpg" alt="Ein Foto unseres Gartens.">
            
            <div class="col-7-index">
                <h2 class="h2-index">Ein Ort der Erholung</h2>
                    <br>
                    <br>
                <div class="text-inside-section">    
                    <p class="p-index">Unser Hotel-Garten ist ein wahres Paradies, 
                    das die perfekte Ergänzung zu Ihrem Aufenthalt darstellt. 
                    Eingebettet inmitten von üppigem Grün und umgeben von der beruhigenden Natur, 
                    bietet unser Garten einen Ort der Erholung und Entspannung.</p>
                    <br>
                    <p>Ein Rückzugsort, der nur darauf wartet, von Ihnen entdeckt zu werden!</p>
                </div>
            </div>

        </section>

    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
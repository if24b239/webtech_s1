<?php session_start(); ?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Startseite"; include 'php_inserts\head.php';

?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section class="main">
        
            <img class="col-5" src="pictures/tavernInside.jpg" alt="Ein Bild unseres Frühstücksbereichs">
            <section class="col-7">
                <h2 display="inline">Willkommen in unserer Taverne</h2>
                <br>
                <br>
                <p display="inline">Beginnen Sie Ihren Morgen mit einem herzhaften Frühstück, das keine Wünsche offenlässt. 
                    In unserer Taverne bieten wir Ihnen eine Auswahl an frischen, regionalen Zutaten – von knusprigem Brot, 
                    das noch warm aus dem Ofen kommt, bis hin zu kräftigen Käsesorten und zartem Fleisch aus der Region. 
                    Unsere Eier stammen von freilaufenden Basilisken. Neben diesen Köstlichkeiten bieten wir Ihnen auch herzhafte Eintöpfe und Suppen, 
                    die in großen Töpfen auf dem offenen Feuer langsam gegart wurden, sowie süße Aufstriche und frisch gepresste Säfte, 
                    die den Tag mit einem frischen und belebenden Geschmack starten lassen.</p>
            </section>
        


            <section class="col-7 text-inside-section2">
                <h2>Ein Ort der Erholung</h2>
                    <br>
                    <br>
                <p>Unser Hotel-Garten ist ein wahres Paradies, 
                    das die perfekte Ergänzung zu Ihrem Aufenthalt darstellt. 
                    Eingebettet inmitten von üppigem Grün und umgeben von der beruhigenden Natur, 
                    bietet unser Garten einen Ort der Erholung und Entspannung.</p>
                    <br>
                    <br>
                    <p>Ein Rückzugsort, der nur darauf wartet, von Ihnen entdeckt zu werden!</p>
            </section>

            <img class="col-5" src="pictures/garden.jpg" alt="Ein Foto unseres Gartens.">
        
        </section>

    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
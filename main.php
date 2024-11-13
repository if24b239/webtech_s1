<?php session_start(); ?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Startseite"; include 'php_inserts\head.php' ?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section class="section main">
        <section class="section-mainLeft">
            <img class="img-main" src="pictures/tavernInside.jpg" alt="Ein Bild unseres Frühstücksbereichs">
            <section class="text-inside-section">
                <p>Wir begrüßen Sie in unserer Taverne. Hier haben Sie die Möglichkeit Ihr herzhaftes Frühstück zu genießen.</p>
            </section>
        </section>
        <section>
        </section>
        <section class="section-mainRight">
            <section class="text-inside-section">
                <p>Entspannen Sie in unserem Garten. Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text TexText Text Text Text Text Text Text Text Text Text Text Text t Text Text Text Text Text Text Text Text Text Text Text Text Text </p>
            </section>

            <img class="img-main" style="float: right;" src="pictures/garden.jpg" alt="Ein Foto unseres Gartens.">
        </section>
    </section>

    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
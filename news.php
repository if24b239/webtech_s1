<?php
    session_start();

    if (!isset($_SESSION["error_news"])) {
        $_SESSION["error_news"] = 0;
    }
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "FAQ und Impressum"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section class="section main">
<!-- TO-DO dieses Formular soll nur angezeigt werden, wenn ein Admin eingeloggt ist-->
    <?php
        if(isset($_SESSION["admin"])&&($_SESSION["admin"]==1)){
            echo'
                <section class="p-wholeContainer">

                    <form action="news_image_upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload"> <br>

                        <label id="alt_image" for="alt_image">Enter alternative text for image:</label>
                        <input type="text" name="alt_image" id="alt_image" required><br>

                        <label id="headline" for="headline">Enter Headline:</label>
                        <input type="text" name="headline" id="headline" required><br>

                        <label id="content" for="content">Enter Content:</label>
                        <input type="text" name="content" id="content" required><br>

                        <input type="submit" value="Bild Hochladen" name="submit">
                    </form>

                </section>
            ';
        }    
    ?>
<!-- Dies ist ein Statisch angelegter News-Beitrag-->
        
        <?php
            if (isset($_SESSION["news_articles"])) {
                foreach ($_SESSION["news_articles"] as $x) {
                    echo '
        <section class="section-mainLeft bordered">
            <img class="img-main" src='.$x["image"].' alt='.$x["alt_image"].'>
            <section class="text-inside-section">
                <h3 style="width:100%">'.$x["headline"].'</h3>
                <br>
                <br>
                <p>'.$x["content"].'</p>
            </section>
        </section>
        <div class="inbetween"></div>
                    ';
                }
            }
        ?>
        <section class="section-mainLeft bordered">
            <img class="img-main" src="pictures/news/dungeon.webp" alt="Ein Bild des Fledermaus-Dungeons">
            <section class="text-inside-section">
                <p>Statischer Beitrag</p>
                <h3>WARNUNG vor dem Betreten des Feldermaus-dungeons</h3>
                <br>
                <br>
                <p>Der lokale Magier warnt, dass im Fledermaus-Dungeon eine riesen Fledermaus gesichtet wurde. 
                    Das Betreten des Dungeons wird Abenteurer*Innen unter Level 25 nicht empfohlen!
                    Auch erfahrene Abenteurer*Innen-Gruppen sollten sich mit außreichend Heiltränken
                    und Wiederbelebungs-Steinen ausstatten bevor sie sich in den Fledermaus-Dungeon wagen.</p>
            </section>

        </section>
        <div class="inbetween"></div>
        
        <section>
            
        </section>
    </section>    
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
<?php
    session_start();
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
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Bild Hochladen" name="submit">
                    </form>

                </section>
            ';
        }    
    ?>
<!-- Dies ist ein Statisch angelegter News-Beitrag-->
        <section class="section-mainLeft bordered">
            <img class="img-main" src="pictures/dungeon.webp" alt="Ein Bild des Fledermaus-Dungeons">
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
        <div class="inbetween">

        </div>
        
        <section>
            
        </section>
    </section>    
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
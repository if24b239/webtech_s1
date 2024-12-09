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

                    <form class=" bordered" action="news_image_upload.php" method="post" enctype="multipart/form-data">
                    <legend>Neues News-Beitrag anlegen:</legend>
                    
                    ';
                
                    if($_SESSION["error_news"]&1){
                        echo'
                            <p class="warning">Bitte wählen Sie ein Bild zum hochladen aus</p>
                            <br>
                        ';
                    }
                    if($_SESSION["error_news"]&2){
                        echo'
                            <p class="warning">Sie können nur Bilder hochladen</p>
                            <br>
                        ';
                    }
                    if($_SESSION["error_news"]&4){
                        echo'
                            <p class="warning">Bitte sowohl Headline und Content als auch den Alternativtext für das Bild ausfüllen</p>
                            <br>
                        ';
                    }
                    if($_SESSION["error_news"]&8){
                        echo'
                            <p class="warning">Momentan sind nur jpg Bilder erlaubt</p>
                            <br>
                        ';
                    }
                    echo'
                        <div class="col-6">
                            <label id="headline" for="headline">Überschrift:</label><br>
                            <input type="text" name="headline" id="headline" required style="width:95%; height:25px;">
                            <br>
                            <br>

                            <label id="content" for="content">Beitragsinhalt:</label><br>
                            <textarea name="content" id="content" style="min-width:95%; max-width:95%; min-height:150px;" ></textarea>
                        </div>

                        <div class="col-6">
                            <br>
                            <input type="file" name="fileToUpload" id="fileToUpload"> <br>
                            <br>
                            <br>
                            <label id="alt_image" for="alt_image">Alternativtext für das Bild:</label><br>
                            <input type="text" name="alt_image" id="alt_image" style="width:95%; height: 30px;" >
                            
                        </div>   

                        <div class="col-12">
                            <button type="submit" value="News-Beitrag Hochladen" name="submit">News-Beitrag anlegen</button>
                        </div>
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
                
                <h3> Warnung vor dem Betreten des Feldermaus-dungeons</h3>
                <br>
                <br>
                <p>Der lokale Magier warnt, dass im Fledermaus-Dungeon eine riesen Fledermaus gesichtet wurde. 
                    Das Betreten des Dungeons wird Abenteurer*Innen unter Level 25 nicht empfohlen!
                    Auch erfahrene Abenteurer*Innen-Gruppen sollten sich mit außreichend Heiltränken
                    und Wiederbelebungs-Steinen ausstatten bevor sie sich in den Fledermaus-Dungeon wagen.</p>
            </section>

        </section>
        
    </section>    
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
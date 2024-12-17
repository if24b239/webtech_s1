<?php
    session_start();

    if (!isset($_SESSION["error_news"])) {
        $_SESSION["error_news"] = 0;
    }
?>
<!--TO-DOS
    -Daten sollten im Formular bleiben bei Fehlern.
    -Datum des Beitrages soll angezeigt werden.
-->

<!DOCTYPE html>
<html lang="de">

<?php $title = "News"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section class="section main">
<!--FORMULAR FÜR ADMINS ZUM ANLEGEN NEUER BEITRÄGE-->
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
<!--ENDE FORMULAR FÜR ADMINS ZUM ANLEGEN NEUER BEITRÄGE-->

<!--AUSGABE DER NEWSBEITRÄGE -->
        <!--Versuch alle Beiträge auszugeben: -->
        <?php include 'db_utils.php' ;
        db_connect();   
        $sql2 = "SELECT n.Ueberschrift, n.Inhalt, date_format(Datum, '%d.%m.%Y') AS 'Datum_formatiert', n.img_alt, n.img_path, n.FK_Admin_ID, p.vorname, p.nachname, p.Gender
                FROM newsbeitrag n JOIN person p
                    ON n.FK_Admin_ID = p.Person_ID;"
        ;
        $result2 = $db->query($sql2);
        while ($row = $result2->fetch_array()) {
            echo'
                <div class="inbetween"> </div>
                <section class="section-mainLeft bordered">
                    <img class="img-main" src="' . $row['img_path'] . '" alt="' . $row['img_alt'] . '">
                    <section class="text-inside-section"> 
                        <h3> ' . $row['Ueberschrift'] . ' </h3>
                        <br>
                        <p> ' . $row['Inhalt'] . ' </p>
                        <br>
                        <br>
                        <p style="font-size: 18px; align-self: right"> <!--geht nicht-->
                            erstellt am ' . $row['Datum_formatiert'] . ' von ' . $row['vorname'] . ' ' . $row['nachname'] . '
                        </p>
                    </section> 
                </section>  
            ';
        }
        ?>              
    </section>    
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
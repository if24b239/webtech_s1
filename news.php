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
        <?php include 'db_utils.php' ;
        db_connect();    
        ?>
       <!-- AUSGABE DES NEWSBEITRAGS MIT DER ID 1 AUS DER DB--> 
        <section class="section-mainLeft bordered">
            <img class="img-main" 
            src="
                <?php
                    $sql = "SELECT * FROM newsbeitrag WHERE Beitrags_ID = 1"; 
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo' '.$row["img-path"].' ';
                    }
                ?>          
            " 
            alt="
            <?php
                    $sql = "SELECT * FROM newsbeitrag WHERE Beitrags_ID = 1"; 
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo' '.$row["img-alt"].' ';
                    }
                    ?>      
            ">
            <section class="text-inside-section">
                
                <h3>
                <?php
                    $sql = "SELECT * FROM newsbeitrag WHERE Beitrags_ID = 1"; 
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo' '.$row["Ueberschrift"].' ';
                    }
                    ?>
                </h3>
                <br>
                <br>
                <p>
                    <?php
                    $sql = "SELECT * FROM newsbeitrag WHERE Beitrags_ID = 1"; 
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo' '.$row["Inhalt"].' ';
                    }
                    ?>
                </p>
                <br>
                <br>
                <p style="font-size: 18px; align-self: right"> <!--geht nicht-->
                    erstellt am 
                    <?php
                    $sql = "SELECT date_format(Datum, '%d.%m.%Y') AS 'Datum_formatiert' FROM newsbeitrag WHERE Beitrags_ID = 1"; 
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo' '.$row["Datum_formatiert"].' ';
                    }
                    ?>
                    von 
                </p>
            </section>

        </section>
        <!-- ENDER DER AUSGABE DES NEWSBEITRAGS MIT DER ID 1 AUS DER DB--> 
        
    </section>    
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
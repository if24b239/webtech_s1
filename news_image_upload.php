<?php
    session_start();

    /*TO-DO:
        Bild-Endungen prüfen + passende Rückmeldung - Ereldigt
        
        Hochgeladenes Bild auf 720x480 Pixel croppen

        News-Einträge Löschen als Admin

        Bild soll auch das aktuelle Datum (sysdate) speichern - ohne Uhrzeit

        Bewertungsmatrix:
        a) Beiträge werden öffentlich in eigenem Bereich angezeigt, Bilder sind gut sichtbar, neuester Beitrag ganz oben 
        b) Für den Upload sind nur Bilddateien erlaubt, Bilder landen in "uploads/news" 
            b) i) Bilder werden serverseitig verkleinert und als Thumbnails konstanter Größe dargestellt
        c) Übersichtliche Darstellung (Beiträge klar voneinander getrennt)
        d) Datum des Beitrags soll angezeigt werden
    
    */ 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {



        //globale Variable zum ausgeben der richtigen Error-message
        $_SESSION["error_news"] = 0; 
        /*0=kein Error, 
        1=no image
        2=not a valid image
        4=alt, headline oder content sind leer
        8= Bild nicht vom passenden Typ
        16=
        32=
        64=*/

        
        $target_dir = "./pictures/news/";
        $target_file = '';

        if ($_FILES["fileToUpload"]["tmp_name"] == '' || $_FILES["fileToUpload"]["name"] == '') {
            $_SESSION["error_news"] += 1; 
        } else {
            // check if uploaded file is an image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check == false) {
                $_SESSION["error_news"] += 2;   
            } else {
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                

                //überprüfung ob Format von Bild in ordnung
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if($imageFileType != "jpg") {
                    $_SESSION["error_news"] += 8; 
                }
                
            }
        }

        if (empty($_POST["alt_image"])
            ||empty($_POST["headline"])
            ||empty($_POST["content"])
        ){
            $_SESSION["error_news"] += 4; 
        }

        // TODO: checks for _POST variables
        $image = $target_file;
        $alt_image = htmlspecialchars($_POST["alt_image"]);
        $headline = htmlspecialchars($_POST["headline"]);
        $content = htmlspecialchars($_POST["content"]);

        // TODO: replace with db entry

        /*$article = [
            "image" => $image,
            "alt_image" => $alt_image,
            "headline" => $headline,
            "content" => $content
        ];*/
        


         
        if ($_SESSION["error_news"] == 0) {  
            move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target_file);

        ///////VERSUCH NEUE NEWSBEITRÄGE IN DIE DATENBANK HOCH ZU LADEN////////////////////
            /*Datenverbindung aufbauen*/ 
            include 'db_utils.php';
            db_conn_check();

            /*SQL-Statement erstellen*/ 
            $sql ="INSERT INTO newsbeitrag (
                    Ueberschrift, Inhalt, Datum, img_alt, img_path, FK_Admin_ID)
                    VALUES (?, ?, NOW(), ?, ?, ?)";
            /*SQL-Statement 'vorbereiten'*/ 
            $stmt = $db->prepare($sql);
            /*Parameter binden*/
            $stmt->bind_param("ssssi", $headline, $content, $alt_image, $image, $admin);
            /*Variablen mit Werten versehen*/
            $admin = 3; /*Im Moment habe ich Ad Min hier noch hardgecodet, weil ich nicht ganz sicher bin, wie ich die ID als Integer übergeben kann*/         
            /*Statement ausführen*/ 
            $stmt->execute();
        ////////////////////////////////////////////////////////////////////////////////////
        }
        header("Location:news.php");
        exit();
    }
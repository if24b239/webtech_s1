<?php
    session_start();

    /*TO-DO:
        ERLEDIGT Bild-Endungen prüfen + passende Rückmeldung 
        
        ERLEDIGT? Hochgeladenes Bild auf fixe Größe croppen

        ERLEDIGT Beim hochladen Admin nicht hardcoden, sondern Person-Id der Admin, die angemeldet ist, hochladen
        
        ERLEDIGT Bild soll auch das aktuelle Datum (sysdate) speichern - ohne Uhrzeit

        Bewertungsmatrix:
        ERLEDIGT a) Beiträge werden öffentlich in eigenem Bereich angezeigt, Bilder sind gut sichtbar, neuester Beitrag ganz oben 
        b) Für den Upload sind nur Bilddateien erlaubt, Bilder landen in "uploads/news" (heißt bei uns pictures/news
            ERLEDIGT? b) i) Bilder werden serverseitig verkleinert und als Thumbnails konstanter Größe dargestellt
        ERLEDIGT c) Übersichtliche Darstellung (Beiträge klar voneinander getrennt)
        ERLEDIGT d) Datum des Beitrags soll angezeigt werden
    
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
        $image_to_upload = imagecreatetruecolor(640, 480);

        if ($_FILES["fileToUpload"]["tmp_name"] == '' || $_FILES["fileToUpload"]["name"] == '') {
            $_SESSION["error_news"] += 1; 
        } else {
            // check if uploaded file is an image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check == false) {
                $_SESSION["error_news"] += 2;   
            } 
            else {
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                

                //überprüfung ob Format von Bild in ordnung
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $allowed_img_types = array("jpg", "gif", "png"); //ich lege ein Array mit den erlauben Endungen an
                $temp = 0;
                foreach ($allowed_img_types as &$x) { //Das Array wird durchlaufen und wenn die Endung des hochgeladenen Bildes 
                        if($x == $imageFileType){//dem entspricht wird die temp-Variable = 0 gesetzt und das durchlaufen unterbrochen
                            $temp = 0;
 
                            $temp_image = imagecreatefromstring(file_get_contents($_FILES['fileToUpload']['tmp_name']));
                            imagecopyresized( $image_to_upload,
                                $temp_image,
                                0, 0, 0, 0,
                                640, 480,
                                $check[0], $check[1]);
                            imagedestroy($temp_image);
                            break;
                        }
                        else{ //nicht dem entspricht wird eine temp Variable = 8 gesetzt. 
                            $temp = 8;
                        }
                }
                        $_SESSION["error_news"] += $temp;      //am ende wird die $_SESSION["error_news] += der temp-Variable gesetzt.
                
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

        
         
        if ($_SESSION["error_news"] == 0) { 
        //BILDER Im pictures/news Ordner SPEICHERN 
            //move_uploaded_file( $image_to_upload, $target_file);
            imagejpeg($image_to_upload, $target_file);
            imagedestroy($image_to_upload);

        //NEWSBEITRÄGE IN DIE DATENBANK HOCHLADEN
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
            $admin = $_SESSION["ID"]; 
            /*Statement ausführen*/ 
            $stmt->execute();
        ////////////////////////////////////////////////////////////////////////////////////
        }
        header("Location:news.php");
        exit();
    }

  
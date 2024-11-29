<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {



        //globale Variable zum ausgeben der richtigen Error-message
        $_SESSION["error_news"] = 0; 
        /*0=kein Error, 
        1=no image
        2=not a valid image
        4=
        8= 
        16=
        32=
        64=*/

        
        $target_dir = "./pictures/news/";
        $target_file = '';

        if (!isset($_FILES["fileToUpload"])) {
            $_SESSION["error_news"] += 1; 
        } else {
            // check if uploaded file is an image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check == false) {
                $_SESSION["error_news"] += 2;   
            } else {
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target_file);
            }
        }

        // save image in ./pictures/news
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // TODO: checks for _POST variables
        $image = $target_file;
        $alt_image = htmlspecialchars($_POST["alt_image"]);
        $headline = htmlspecialchars($_POST["headline"]);
        $content = htmlspecialchars($_POST["content"]);

        // TODO: replace with db entry
        $article = [
            "image" => $image,
            "alt_image" => $alt_image,
            "headline" => $headline,
            "content" => $content
        ];
         
        if ($_SESSION["error_news"] == 0) {
            
            $_SESSION["news_articles"][] = $article;
            header("Location:news.php");
        }
    }
<?php

session_start();

//TO-DO
    //- Wenn Username nicht mit statischem übereinstimmt: Rückmelden dass User noch nicht angelegt ist
    //

// replace with databank retrieval
$static_password = 'Password_1234';
$static_user_name = 'MaxMustermann';

   

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["error_login"] = 0;
         /*0=kein Error, 
        1=Eine Eingabe ist leer, 
        2=Passwort stimmt nicht, 
        4=User name stimmt nicht
        8=
        16=
        32=
        64=*/

    if($_POST["password_login"] == $static_password && $_POST["user_name_login"] == $static_user_name){   
        $_SESSION["user_name"] = htmlspecialchars($_POST["user_name_login"]);
        $_SESSION["password"] = htmlspecialchars($_POST["password_login"]);

        
        $_SESSION["logged_in"] = 1;
    }
    //Eine Eingabe ist leer, 
    if(empty($_POST["password_login"])||empty($_POST["user_name_login"])){
        $_SESSION["error_login"] += 1;
    }

    //Passwort stimmt nicht
    if($_POST["password_login"] != $static_password){
        $_SESSION["error_login"] += 2;
    }

    //User name stimmt nicht
    if($_POST["user_name_login"] != $static_user_name){
        $_SESSION["error_login"] += 4;
    }

    if($_SESSION["error_login"]>0){
        header("Location:login.php"); //wenn das Login nicht erfolgreich war schicken wir mit Fehlermeldung zurück zum Login
        exit();
    }
    if($_SESSION["error_login"]==0 && $_SESSION["logged_in"]==1){ //wenn Login erfolgreich ist schicken wir zum profil
        header("Location:profile.php");
        exit();
    }
        
}

else {
    header("Location:faq.php"); //wenn versucht wurde über eine andere Methode als Post zuzugreifen schicken wir zu den FAQs
    exit();
}
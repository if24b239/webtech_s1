<?php

session_start();

//TO-DO
    //- Wenn Username nicht mit statischem übereinstimmt: Rückmelden dass User noch nicht angelegt ist
    //

// replace with databank retrieval
global $static_users;
$static_users = array(
    'MaxMustermann' => 'Password_1234',
    'admin' => 'admin');

$local_pwd='';

function validUsername($name) {
    global $static_users;
    $found = false;
    foreach ($static_users as $x => $ignore) {
        if ($name == $x) {
            $found = true;
        }
    }
    return $found;
}

function validPassword($pwd) {
    global $static_users;
    $found = 0;
    foreach ($static_users as $x) {
        if ($pwd == $x) {
            $found = 1;
        }
    }
    return $found;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["error_login"] = 0;
    $_SESSION["admin"] = FALSE;
         /*0=kein Error, 
        1=Eine Eingabe ist leer, 
        2=Passwort stimmt nicht, 
        4=User name stimmt nicht -> wir brauchen eigentlich keine Zwei unterschiedlichen Rückmeldungen
        8=
        16=
        32=
        64=*/

    
    foreach ($static_users as $user => $pwd) {
        if($_POST["password_login"] == $pwd && $_POST["user_name_login"] == $user){   
            $_SESSION["user_name"] = htmlspecialchars($_POST["user_name_login"]);
            
            $_SESSION["logged_in"] = 1;

            if ($user == 'admin') {
                $_SESSION["admin"] = TRUE;
            }
        }
    }
        
    //Eine Eingabe ist leer, 
    if(empty($_POST["password_login"]) || empty($_POST["user_name_login"])){
        $_SESSION["error_login"] += 1;
    }

    //Passwort stimmt nicht
    if(!validPassword($_POST["password_login"])){
        $_SESSION["error_login"] += 2;
    }

    //User name stimmt nicht
    if(!validUsername($_POST["user_name_login"])){
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
<?php

session_start();

//TO-DO
    //- Wenn Username nicht mit statischem übereinstimmt: Rückmelden dass User noch nicht angelegt ist
    //

// replace with databank retrieval
$static_password = 'Password_1234';
$static_user_name = 'MaxMustermann';
if(!isset($_SESSION["wrong_password"])){
    $_SESSION["wrong_password"]=0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST["password_login"] == $static_password && $_POST["user_name_login"] == $static_user_name){   
        $_SESSION["user_name"] = htmlspecialchars($_POST["user_name_login"]);
        $_SESSION["password"] = htmlspecialchars($_POST["password_login"]);

        $_SESSION["wrong_password"] = 0;
        $_SESSION["logged_in"] = 1;

        header("Location:profile.php");
        exit();

    }
    else {
        $_SESSION["wrong_password"] = 1;

        header("Location:login.php");
        exit();
    }
}
else {
    header("Location:faq.php");
    exit();
}
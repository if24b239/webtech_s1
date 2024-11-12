<?php

    session_start();
    $_SESSION["static_password"] ='Password_1234';
    if(!isset($_SESSION["wrong_password"])){
        $_SESSION["wrong_password"]=0;
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST["password_login"] == $_SESSION["static_password"]){   
            $_SESSION["user_name"] = htmlspecialchars($_POST["user_name_login"]);
            $_SESSION["password"] = htmlspecialchars($_POST["password_login"]);

            $_SESSION["wrong_password"] = 0;
            $_SESSION["logged_in"] = 1;

            header("Location:profile.php");
            exit();

        }
        else if($_POST["password_login"] != $_SESSION["static_password"]){
            $_SESSION["wrong_password"] = 1;

            header("Location:login.php");
            exit();
        }
}
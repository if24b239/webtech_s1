<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $_SESSION["admin"] = FALSE;
    $_SESSION["error_login"] = 0;
    /*  0=kein Error, 
        1=Eine Eingabe ist leer, 
        2=Passwort und Benutzername wurden nicht im selben Datensatz in der DB gefunden.     
    */

    //Eingabewerte vorbereiten
        $username_input = htmlspecialchars($_POST["user_name_login"]);
        $password_input = htmlspecialchars($_POST["password_login"]);
        $hashed_password = password_hash($_POST["password_login"], PASSWORD_DEFAULT);

    //Variable damit der Username im Formular bleibt, falls Fehlermeldung
    $_SESSION["log_user"] = $username_input;

    //Überprüfung ob Eingabe leer, wenn ja zurück schicken. 
        if(empty($username_input)||empty($password_input)){
            $_SESSION["error_login"]+=1;

            header("Location:login.php");
            exit();
        }

//Über Datenbank abfragen ob Passwort und Benutzername in Datenbank sind. 
        //Datenbankverbindungaufbauen 
        include 'db_utils.php';
        db_conn_check();

        //SELECT-Abfrage über Usernamen, Passwörter und Admin_ID aus der DB
        $sql ="SELECT username, passwort, Admin_ID FROM person;";
        $result = $db->query($sql);

        //Abfrage an die DB ob passwort und username in einer Abfrage vorkommen
        while ($row = $result->fetch_array()) {
            //Wenn Passwort und Username in einem Datensatz übereinstimmen setzen wir loggen_In auf 1 
            if($row['username']==$username_input){
                if(password_verify($password_input, $row["passwort"])){
                    $_SESSION["logged_in"] = 1;
                    $_SESSION["user"] = $username_input;

                    //Wenn die person, die sich einloggt ein Admin ist, hat sie einen Eintrag in der Spalte Admin_ID wir setzten die Session Variable diesbezüglich auf 1, damit Admin spezifische Dinge freigeschaltet werden.
                    if($row['Admin_ID']!=NULL){
                        $_SESSION["admin"]=1;
                    }
                //dann verlinken wir zum Profil
                header("Location:profile.php");
                exit();

                }             
            }
        }
        
        //Hierher kommen wir nur, wenn Passwort und Username nie übereingestimmt haben:
        $_SESSION["error_login"]+=2;
        header("Location:login.php");
        exit();
}

//Hier landen wir nur, wenn die Requestmethode, mit der das Formulareingesendet wurde nicht POST war:
header("Location:faq.php");
exit();

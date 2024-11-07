<?php //weil reines PHP-File nur aufgemacht, nicht geschlossen

if(!isset($_SESSION)){
    session_start();
}

//this file Should be in a private folder not in a public one for security reasons

//TO-DOS
//E-Mail muss ein @ enthalten darf keine Leerzeichen enthalten - Lena
//Nachname und Vorname dürfen nur Buchstaben - und Leerzeichen enthalten - Lena
//Passwort  muss funktionieren lol - Marold 
//Anrede auf gültige eingaben limitieren - Marold

//Kontrolle ob Input mit der Methode "Post" geschickt wurde 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //nach der Kontrolle werden die Daten in Variablen gespeichert
        //"htmlspecialchars"-Funktion wandelt Data in html-Enteties um und verhindert so, dass Code über die Formulare injiziert werden kann (Cross-site Scripting attacks)
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email"]);
        //ich glaube wir brauchen gar keine eigene Username Registration Variable aber habe es mal so gelassen. Wenn wir es ändern dann auch beim Registrierungsformular
    $user_name_registration = htmlspecialchars($_POST["user_name_registration"]);
    $password = htmlspecialchars($_POST["password"]);
    $password_repitition = htmlspecialchars($_POST["password_repitition"]);
    $gender = htmlspecialchars($_POST["gender"]);
    
    $site_we_send_to_in_case_of_wrong_input = 'registration.php';

    //Leere Eingaben Serverseitig verhindern:
    if((empty($first_name))
    || (empty($last_name))
    || (empty($email))
    || (empty($user_name_registration))
    || (empty($password))
    || (empty($password_repitition))
    ){
        header("Location:$site_we_send_to_in_case_of_wrong_input");
        exit();     
    }
    
    //Überprüfung ob Passwörter gleich sind
    if($password != $password_repitition){
        $_SESSION["password_check"] = 'Error';
        header("Location:$site_we_send_to_in_case_of_wrong_input");
        exit(); 
    }
    
    header("Location:main.php");
    exit();
}

//Falls die Userin diese Seite auf einem anderen Weg als über das Formular erreicht hat, wird sie auf die Startseite verwiesen
else { // if ($_SERVER["REQUEST_METHOD"] == "POST")
    header("Location:main.php");
    exit();
}


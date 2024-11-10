<?php //weil reines PHP-File nur aufgemacht, nicht geschlossen

if(!isset($_SESSION)){
    session_start();
}

//this file Should be in a private folder not in a public one for security reasons

//TO-DOS
//erledigt E-Mail muss ein @ enthalten darf keine Leerzeichen enthalten - Lena
//erledigt Nachname und Vorname dürfen nur Buchstaben - und Leerzeichen enthalten - Lena
//Passwort  muss funktionieren lol - Marold 
//Anrede auf gültige eingaben limitieren - Marold
//doch einzelne SESSION Variablen für jede Fehlermeldung anlegen, damit mehr als eine Warnung gleichzeig gegeben werden kann? nein habe nur für Vorname, Nachname noch eine ergänzt weil alle anderen Eingaben eh nur via illegaler F12 betätigung erreicht werden können


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

    //globale Variable zum ausgeben der richtigen Error-message
    $_SESSION["error_registration"]='0'; 
    /*0=kein Error, 
    1=Eine Eingabe ist leer, 
    2=Passwörter sind unterschiedlich, 
    4=Nachname enthält invalide zeichen, 
    8=Vorname enthält invailde zeichen, 
    16=E-Mail enthält invailde zeichen
    32=Gender ist nicht eine der optionen
    64=Password input falsch strukturiert*/


    //Leere Eingaben Serverseitig verhindern:
    if((empty($first_name))
    || (empty($last_name))
    || (empty($email))
    || (empty($user_name_registration))
    || (empty($password))
    || (empty($password_repitition))
    ){
        $_SESSION["error_registration"]= 1;
        header("Location:$site_we_send_to_in_case_of_wrong_input");    
    }
    
    //Überprüfung ob Passwörter gleich sind
    if($password != $password_repitition){
        $_SESSION["error_registration"] = 2;
        header("Location:$site_we_send_to_in_case_of_wrong_input");
    }
    //Nachname und Vorname dürfen nur Buchstaben - und Leerzeichen enthalten
    //Nachname
    if (!preg_match('/^[-a-zA-Z[:space:]_]+$/', $last_name)){
        $_SESSION["error_registration"] = 4; //wird auf 4 gesetzt, damit auf der registration.php die richtige Errormeldung ausgegeben wird.
        header("Location:$site_we_send_to_in_case_of_wrong_input");      
    }

    //vorname
    if(!preg_match('/^[-a-zA-Z[:space:]_]+$/', $first_name)){
        $_SESSION["error_registration"] = 8; //wird auf 8 gesetzt, damit auf der registration.php die richtige Errormeldung ausgegeben wird.
        header("Location:$site_we_send_to_in_case_of_wrong_input");      
    }

    //E-Mail muss ein @ enthalten darf keine Leerzeichen enthalten
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ /*Funktion prüft ob die eingegebene E-Mail eine valide ist*/ 
        $_SESSION["error_registration"] = 16; //wird auf 5 gesetzt, damit auf der registration.php die richtige Errormeldung ausgegeben wird.
        
    }

    //Anrede soll nur female male other sein
    if (!($gender == "female" || $gender == "male" || $gender == "other")) {
        $_SESSION["error_registration"] = 32;
    }

    if ($_SESSION["error_registration"] > 0) {
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


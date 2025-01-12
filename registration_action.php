<?php //weil reines PHP-File nur aufgemacht, nicht geschlossen

session_start();

if (!isset($_SESSION["user_name"])) {
    $_SESSION["user_name"] = '';
}


//TO-DOS
//this file Should be in a private folder not in a public one for security reasons
//erledigt . Passwort muss zweimal eingegeben werden und wird in DB verschlüsselt


//Kontrolle ob Input mit der Methode "Post" geschickt wurde 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //"htmlspecialchars"-Funktion wandelt Data in html-Enteties um und verhindert so, dass Code über die Formulare injiziert werden kann (Cross-site Scripting attacks)
    //VARAIBLEN zur Verwendung in diesem File
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email"]);
        //ich glaube wir brauchen gar keine eigene Username Registration Variable aber habe es mal so gelassen. Wenn wir es ändern dann auch beim Registrierungsformular
    $user_name_registration = htmlspecialchars($_POST["user_name_registration"]);
    $password = htmlspecialchars($_POST["password"]);
    $password_repitition = htmlspecialchars($_POST["password_repitition"]);
    $gender = htmlspecialchars($_POST["gender"]);

    $site_we_send_to_in_case_of_wrong_input = 'registration.php';

    //VARIABLEN damit die Einträge, bei Fehlermeldung trotzdem erhalten bleiben.
    $_SESSION["reg_first_name"] = $first_name;
    $_SESSION["reg_last_name"] = $last_name;
    $_SESSION["reg_email"] = $email;
    $_SESSION["reg_user"] = $user_name_registration;
    $_SESSION["reg_gender"] = $gender;

//////////////////////////////////////////
/////SERVERSEITIGE VALIDIERUNG////////////
//////////////////////////////////////////
    //globale Variable zum ausgeben der richtigen Error-message
    $_SESSION["error_registration"]=0; 
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
    || (empty($gender))
    ){
        $_SESSION["error_registration"] += 1; 
    }
    
    //Überprüfung ob Passwörter gleich sind
    if($password != $password_repitition){
        $_SESSION["error_registration"] += 2;
    }
    //Nachname und Vorname dürfen nur Buchstaben - und Leerzeichen enthalten
    //Nachname
    if (!preg_match('/^[-a-zA-Z[:space:]äöüÄÖÜ_]+$/', $last_name)){
        $_SESSION["error_registration"] += 4; //wird auf 4 gesetzt, damit auf der registration.php die richtige Errormeldung ausgegeben wird.   
    }

    //vorname
    if(!preg_match('/^[-a-zA-Z[:space:]äöüÄÖÜ_]+$/', $first_name)){
        $_SESSION["error_registration"] += 8; //wird auf 8 gesetzt, damit auf der registration.php die richtige Errormeldung ausgegeben wird.     
    }

    //E-Mail muss ein @ enthalten darf keine Leerzeichen enthalten
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ /*Funktion prüft ob die eingegebene E-Mail eine valide ist*/ 
        $_SESSION["error_registration"] += 16; //wird auf 5 gesetzt, damit auf der registration.php die richtige Errormeldung ausgegeben wird.
    }

    //Anrede soll nur female male other sein
    if (!($gender == "female" || $gender == "male" || $gender == "other")) {
        $_SESSION["error_registration"] += 32;
    }

    //Prüft ob die Passwort Variabele die folgenden Zeichen enthält. 
    if (strlen($_POST["password"]) <= '8'
        ||!preg_match("#[a-z]+#",$password)
        ||!preg_match("#[A-Z]+#",$password)
        ||!preg_match("#[0-9]+#",$password)
        ){
        $_SESSION["error_registration"] += 64;
    }

    if ($_SESSION["error_registration"] > 0) {
        header("Location:$site_we_send_to_in_case_of_wrong_input");
        exit();
    }

//////////////////////////////////////////////////////////////////////////
////////////////////INSERT INTO DB////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

    //Datenbankverbindungaufbauen 
    include 'db_utils.php';
    db_conn_check();
    //SQL-Statement erstellen 
    $sql = "INSERT INTO person (vorname, nachname, e_mail, Gender, username, passwort)
            VALUES (?, ?, ?, ?, ?, ?);
            ";
    //SQL-Statement „vorbereiten” 
    $stmt = $db->prepare($sql);
    //Parameter binden
    $stmt-> bind_param("ssssss", $first_name, $last_name, $email, $gender, $user_name_registration, $hashedpassword);
    //VariablenmitWerteversehen 
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT); /*Erklärung: In der PHP-Funktion password_hash($passwordplaintext, PASSWORD_DEFAULT) wird der Parameter PASSWORD_DEFAULT verwendet, um anzugeben, dass die Funktion den "besten" (aktuellsten) verfügbaren Hashing-Algorithmus für die Passwortsicherung verwenden soll. Im Moment (Stand Dezember 2024) ist dies der BCRYPT-Algorithmus, der als sicher gilt.*/
    //Statement ausführen
    $stmt->execute();

    //Session_Variablen für die Ausgabe der Reservierungsdaten beim Profil - kann gelöscht werden wenn Datenbank inkludiert
    $_SESSION["gender"]=$gender;
    $_SESSION["first_name"]=$first_name;
    $_SESSION["last_name"]=$last_name;
    $_SESSION["email"]=$email;
    $_SESSION["user_name"]=$user_name_registration;
    //Ende Session_Variablen für die Ausgabe der Reservierungsdaten beim Profil - bitte löschen, wenn Datenbank inkludiert

    header("Location:login.php");
    exit();
}

//Falls die Userin diese Seite auf einem anderen Weg als über das Formular erreicht hat, wird sie auf die Startseite verwiesen
else { // if ($_SERVER["REQUEST_METHOD"] == "POST")
    header("Location:faq.php");
    exit();
}


<?php 
    if (!isset($_SESSION["admin"])) {
        $_SESSION["admin"] = 0;
    }
    
    if(!isset($_SESSION["logged_in"])){
        $_SESSION["logged_in"] = 0;
        $_SESSION["admin"] = 0;

    }
    
    
    if(!isset($_SESSION["gender"])){
        $_SESSION["gender"]='';
    }
    if(!isset($_SESSION["first_name"])){
        $_SESSION["first_name"]='';
    }
    if(!isset($_SESSION["last_name"])){
        $_SESSION["last_name"]='';
    } 

    /* Ersatz für Datenbank? 
        if ($_SESSION["logged_in"] == 1) {
        if ($_SESSION["admin"] == 1) {
            $_SESSION["gender"] = 'other';
            $_SESSION["first_name"] = "Ad";
            $_SESSION["last_name"] = "Min";
        } else {
            $_SESSION["gender"] = 'male';
            $_SESSION["first_name"] = 'Max';
            $_SESSION["last_name"] = 'Mustermann';
        }
    }*/

//////////////Versuch mit DB/////////////
    include 'db_utils.php';
    db_conn_check();
 // SQL-Abfrage, um die Daten aus der 'person'-Tabelle zu holen
    $sql = "SELECT vorname, nachname, gender, E_Mail, Admin_ID, Person_ID FROM person WHERE username = ?";

// Bereite die SQL-Anweisung vor (um SQL-Injektionen zu verhindern)
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user"]); // Bindet den Session-Wert (Benutzername) an die Abfrage

// Führe die Abfrage aus
    $stmt->execute();

// Hole das Ergebnis
    $stmt->bind_result($first_name, $last_name, $gender, $email, $admin, $ID);

// Wenn es ein Ergebnis gibt, werden die Session-Variablen gesetzt
    if ($stmt->fetch()) {
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["gender"] = $gender;
        $_SESSION["email"] = $email;
        $_SESSION["admin"] = $admin;
        $_SESSION["ID"] = $ID;
    }

// Die vorbereitete Anweisung wird geschlossen
    $stmt->close();

////////////////////////////////////////

/* 
USAGE: no special usage
*/

echo '


<nav>

    <input type="checkbox" id="toggle_button_nav">
    <label for="toggle_button_nav" class="toggle_button_nav">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </label>

    <ul>';
    /*Versuch etwas nur anzuzeigen wenn ein Admin eingeloggt ist*/
        if($_SESSION["admin"] != NULL){
            echo'
                <li><a href="admin_user_administration.php">User-Verwaltung</a></li>
                <li><a href="admin_reservation_administration.php">Reservierungs-Verwaltung</a></li>
            ';
        }
/*Begrüßung wenn eingeloggt*/
    echo'
        <p style="font-weight: bold;">';
            if($_SESSION["logged_in"] == 1){
                if($_SESSION["gender"]=='female'){
                    echo'Willkommen Frau '.$_SESSION["last_name"].'!';
                }
                if($_SESSION["gender"]=='male'){
                    echo'Willkommen Herr '.$_SESSION["last_name"].'!';
                }
                if($_SESSION["gender"]=='other'){
                    echo'Willkommen '.$_SESSION["first_name"].' '.$_SESSION["last_name"].'!';
                }
            }
        echo'
        </p>
            
        <li><a href="index.php">Startseite</a></li>
        <li><a href="news.php">News</a></li>
';

if ($_SESSION["logged_in"] == 1) {
    echo '
        <li><a href="profile.php">Profil</a></li>
        <li><a href="room_reservation.php">Zimmerreservierung</a></li>   
        <li><a href="logout_action.php">Logout</a></li>
    ';
}

if($_SESSION["logged_in"] == 0){
    echo'
        <li><a href="registration.php">Registrierung</a></li>
        <li><a href="login.php">Login</a></li>
    ';
}
echo'
    </ul>

</nav>
';

?>
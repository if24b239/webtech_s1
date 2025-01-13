<?php
////////// wird nicht alleine verwendent -> db_conn_check //////////
function db_connect() {    
    global $db;
    
    if (isset($db)) {
        return;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "hotel_website";

    $db = new mysqli($servername, $username, $password, $database);

    if ($db->connect_error) {
        echo "Connection Error" . $db->connection_error;
        exit();
    }
}

////////////Funktion um Verbindung aufzubauen /////////////////
function db_conn_check() {
    
    global $db;
    
    if ($db) {
        return;
    }
    
    db_connect();
}


////////// Funktion prüft ob eingegebener username und passwort in der DB in einem Datensatz gespeichert sind, wenn ja: returned true////////////
function db_login_check($username, $password) {
    global $db;
    db_conn_check();

    $sql = $mysqli->prepare("SELECT username, passwort
        FROM person
        WHERE username = ?
        AND passwort = ?;");

    $sql->bind_param("ss", $username, $password);

    $sql->execute();

    $result = $sql->get_result(); 
    
    if ($result) {
        return true;
    }

    return false;
}

//////////////////////////////////////////////
function db_registration_check() {
    global $db;
    db_conn_check();
}

function db_registration_add() {
    global $db;
    db_conn_check();
}


function db_news_add() {
    global $db;
    db_conn_check();
}

function db_reserved_timeduration($room){
    global $db;
    db_conn_check();

 // SQL-Abfrage, um die Daten aus der 'reservation'-Tabelle zu holen
    $sql = "SELECT date_format(Abreisedatum, '%d.%m.%Y') AS 'Abreisedatum', date_format(Anreisedatum, '%d.%m.%Y') AS 'Anreisedatum'  
            FROM reservierung 
            WHERE FK_Zimmer_ID = $room";

    $result = $db->query($sql);

    echo'<br>';

    while ($row = $result->fetch_array()) {
        echo'
            <p> '.$row['Anreisedatum'] .' bis '.$row['Abreisedatum'] .' </p>
        ';
    }
}

function db_news_get(){

    global $db;
    db_conn_check(); 
    $sql2 = "SELECT n.Ueberschrift, n.Inhalt, date_format(Datum, '%d.%m.%Y') AS 'Datum_formatiert', n.img_alt, n.img_path, n.FK_Admin_ID, p.vorname, p.nachname, p.Gender, n.Beitrags_ID
            FROM newsbeitrag n JOIN person p
                ON n.FK_Admin_ID = p.Person_ID
            ORDER BY Datum_formatiert asc
            ;"
    ;
    $result2 = $db->query($sql2);

    // display the news beiträge
    while ($row = $result2->fetch_array()) {
        echo'
            <div class="inbetween"> </div>
            <section class="section-newsLeft bordered">
                <img class="img-news" src="' . $row['img_path'] . '" alt="' . $row['img_alt'] . '">
                <section class="text-inside-news-section"> 
                    <h1 class="h1-news"> ' . $row['Ueberschrift'] . ' </h3>
                    <br>
                    <p> ' . $row['Inhalt'] . ' </p>
                    <br>
                    <br>
                    <p class="p-news">
                        erstellt am ' . $row['Datum_formatiert'] . ' von ' . $row['vorname'] . ' ' . $row['nachname'] . '
                    </p>
                ';
                if(isset($_SESSION["admin"])&&($_SESSION["admin"]!=NULL)){ 
                echo'
                    <br>  
                    <form action="news_delete.php" method="POST">
                        <input type="hidden" name="beitrags_ID" value="'.$row['Beitrags_ID'].'">
                        <button type="submit">Beitrag löschen</button>
                   </form>
                ';
            }
            echo'
                </section> 
            ';
            
        echo'
            </section>  
        
        ';
    }             
}


function db_userinformation_profile(){
    global $db;
    db_conn_check(); 

    $sql ="SELECT gender, vorname, nachname, username, E_Mail
            FROM person
            WHERE Person_ID = ?";
    
    // Bereite die SQL-Anweisung vor (um SQL-Injektionen zu verhindern)
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $_SESSION["ID"]); // Bindet den Session-Wert (ID) an die Abfrage

// Führe die Abfrage aus
    $stmt->execute();

// Hole das Ergebnis
    $stmt->bind_result($gender, $vorname, $nachname, $username, $E_Mail);

// Wenn es ein Ergebnis gibt, werden sie ausgeben
    if($stmt->fetch()){
        echo'
            <div>
                <div class="col-12">
                    Anrede: 
        ';
                    if($gender== "female"){
                        echo'Frau';
                    }
                    if($gender=='male'){
                        echo'Herr';
                    }
                    if($gender=='other'){
                        echo'Vorname Nachname';
                    }
                    echo'
                        <br>
                        <br>
                        Vorname:  '.$vorname.'
                        <br>
                        <br>
                        Nachname:  '.$nachname.'
                        <br>
                        <br>
                        Username:  '.$username.'
                        <br>
                        <br>
                        E-Mail Adresse:  '.$E_Mail.'
                        <br>
                        <br>
                </div>   
            </div>
                    ';
    }
// Die vorbereitete Anweisung wird geschlossen
    $stmt->close();    
}


?>
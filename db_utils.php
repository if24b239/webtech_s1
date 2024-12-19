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

function db_news_get() {
        $sql2 = "SELECT n.Ueberschrift, n.Inhalt, date_format(Datum, '%d.%m.%Y') AS 'Datum_formatiert', n.img_alt, n.img_path, n.FK_Admin_ID, p.vorname, p.nachname, p.Gender
        FROM newsbeitrag n JOIN person p
            ON n.FK_Admin_ID = p.Person_ID;"
    ;
    $result2 = $db->query($sql2);
    while ($row = $result2->fetch_array()) {
    echo'
        <div class="inbetween"> </div>
        <section class="section-mainLeft bordered">
            <img class="img-main" src="' . $row['img_path'] . '" alt="' . $row['img_alt'] . '">
            <section class="text-inside-section"> 
                <h3> ' . $row['Ueberschrift'] . ' </h3>
                <br>
                <p> ' . $row['Inhalt'] . ' </p>
                <br>
                <br>
                <p style="font-size: 18px; align-self: right"> <!--geht nicht-->
                    erstellt am ' . $row['Datum_formatiert'] . ' von ' . $row['vorname'] . ' ' . $row['nachname'] . '
                </p>
            </section> 
        </section>  
    ';
    }
}

function db_news_add() {
    global $db;
    db_conn_check();
}

?>
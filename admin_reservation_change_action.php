<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //Variablen:
    $reservation_ID = htmlspecialchars($_POST["Reservierungs_ID"]);
    $new_status = htmlspecialchars($_POST["new_status"]);

    $_SESSION["error_reservation_change"] = 0;
    /*
    0 = kein Error
    1 = Eine Eingabe leer
    2 = ID  Keine Zahl
    4 = ID nicht in DB
    8 = Status keine der 3 Optionen
    */

    //DEBUGGING
   /* echo'Reservierungs-ID: '.$reservation_ID.'
        <br>
        neuer Status: '.$new_status.' 
    ';
    die();*/

    /////////////////////////////////////////////////////
    ////////////////VALIDIERUNG//////////////////////////
    /////////////////////////////////////////////////////
    if(empty($reservation_ID)||empty($new_status)){
        $_SESSION["error_reservation_change"] += 1;
    }
    if(!is_numeric($reservation_ID)){
        $_SESSION["error_reservation_change"] += 2;
    }
    //geht in jedem Fall in diese Unterscheidung
    if(!($new_status=='neu'||$new_status=='storniert'||$new_status=='bestaetigt')){
        $_SESSION["error_reservation_change"] += 8;
    }


    //DEBUGGING
    /*echo''.$_SESSION["error_reservation_change"].'';
    die();*/

    if($_SESSION["error_reservation_change"]>0){
        header("Location:admin_reservation_administration.php");
        exit();
    }

    /////////////////////////////////////////////////////
    ////////////////DATENBANKEINTRAG/////////////////////
    /////////////////////////////////////////////////////

    
   

    //Datenbankverbindungaufbauen
    include 'db_utils.php';
    db_conn_check();
     //SQL-Statement erstellen 
    $sql = "UPDATE reservierung
                SET status = ? 
                WHERE Reservierungs_ID = ?;
            ";
     //SQL-Statement „vorbereiten” 
    $stmt = $db->prepare($sql); 
     //Parameter binden 
    $stmt-> bind_param("si", $new_status, $reservation_ID); 
     //VariablenmitWerteversehen 
        /*haben schon Werte*/
     //Statement ausführen
    $stmt->execute();
    
    //Prüfen ob Abfrage ein Ergebnis hat
    // Ergebnis abrufen
    $result = $stmt->get_result();
    if ($result->num_rows != 1) {
        //Wenn nein: Error erhöhen 
        $_SESSION["error_reservation_change"] += 2;
    }

    header("Location:admin_reservation_administration.php");
    exit();
}

echo'';
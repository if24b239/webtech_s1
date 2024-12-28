<?php 

session_start();


if (!isset($_SESSION["reservierungen"])) {
    $_SESSION["reservierungen"] = array();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $room = htmlspecialchars($_POST["room"]);
    $arrival = htmlspecialchars($_POST["arrival"]);
    $departure = htmlspecialchars($_POST["departure"]);
    $breakfast = htmlspecialchars($_POST["breakfast"]);
    $parking = htmlspecialchars($_POST["parking"]);
    $special_requests = htmlspecialchars($_POST["special_requests"]);
    $pet = 0;
        if (isset($_POST["pet1"]) && $_POST["pet1"] == 1) {
            $pet += 4;
        }
        if (isset($_POST["pet2"]) && $_POST["pet2"] == 2) {
            $pet += 2;
        }
        if (isset($_POST["pet3"]) && $_POST["pet3"] == 4) {
            $pet += 8;
        }

    /*$_SESSION["pet"] = htmlspecialchars($pet);*/
    
    $_SESSION["error_reservation"] = 0;
    /*0=kein Error, 
    1=Eine Eingabe ist leer, 
    2=room falsches format or existiert nicht, 
    4=arrival/departure wrong format,
    8=room not available
    16=pet currently not allowed
    32=no parking free
    64=departure <= arrival*/

    //1=Eine Eingabe ist leer
    if((empty($room))
    || (empty($arrival))
    || (empty($departure))
    || (empty($breakfast))
    || (empty($parking))
    /*|| (empty($special_requests)) -- habe ich ausgeklammert weil die Leute ja auch keine Sonderwünsche haben dürfen*/
    /*|| (empty($pet))  -- habe ich ausgeklammert weil die Möglichkeit besteht kein Tier mitzunehmen*/
    ){
        $_SESSION["error_reservation"] += 1;
    }
    //2=room falsches format or existiert nicht
    
    //4=arrival/departure wrong format

    //8=room not available
    //Datenbankabfrage über alle reservierungen des Raumes die in der Zukunft des gestrigen Datums liegen
    
    include 'db_utils.php';
    db_conn_check();
    $sql = "SELECT Anreisedatum, Abreisedatum FROM reservierung 
            WHERE FK_Zimmer_ID = " . $_POST['room'] . "
            AND 
            (Anreisedatum BETWEEN '$arrival' AND '$departure')
            OR (Abreisedatum BETWEEN '$arrival' AND '$departure')
            OR (Anreisedatum <= '$arrival' AND Abreisedatum >= '$departure');
            ";
    $result = $db->query($sql);

    //Erhöhen des Errors, wenn die SQL Abfrage einen Datensatz enthält. 
    if($result->num_rows > 0 ) {
        $_SESSION["error_reservation"] += 8;
    }
    //16=

    //32=

    //64=departure <= arrival
    $dateTimestampArrival = strtotime($arrival);
    $dateTimestampDeparture = strtotime($departure);
    if($dateTimestampDeparture <= $dateTimestampArrival){
        $_SESSION["error_reservation"] += 64;     
    }
    if($_SESSION["error_reservation"] > 0){
        /*DEBUGGING echo'room: '.$room.', Ankunft: '. $arrival .', Abreise: '. $departure .', breakfast: '. $breakfast .', Parkplatz: '. $parking .'';*/
        header("Location:room_reservation.php");
        exit();
    }
    if($_SESSION["error_reservation"] == 0){
    //////EINTRAG IN DIE DB////////////////
        //Datenbankverbindungaufbauen
        db_conn_check();
        //SQL-Statement erstellen
        $sql2 = "INSERT INTO `reservierung` (`Anreisedatum`, `Abreisedatum`, `Anlegedatum`, `Parkplatz`, `Fruehstueck`, `Haustier`, `Sonderwuensche`, `status`, `FK_Zimmer_ID`, `FK_KundInnen_ID`)
                    VALUES(?, ?, NOW(), ?, ?, ?, ?, 'neu', ?, ?)
                ";
        //SQL-Statement „vorbereiten”
        $stmt2 = $db->prepare($sql2);
        //Parameter binden
        $stmt2->bind_param("ssiiisii", $arrival, $departure, $parking, $breakfast, $pet, $special_requests, $room, $customer);
        //VariablenmitWerteversehen
            /*die Werte für arrival, departure, special_requests und room haben wir oben bei der validierung schon festgelegt*/
            /*Was noch fehlt ist die Kund*In  von der die Reservierung durchgeführt wurde, diese ist in der Session gespeichert*/
        $customer = $_SESSION["ID"];
            /*parking, breakfast und Haustiere wird angepasst, damit die Berechnung des Gesammtpreises später einfacher wird*/
      
            if($parking == 1){
                $parking = 0;
            }/*Wenn parking ausgewählt ist, ist es bereits 2 was dem Preis für Parking entspricht, daher kein else if statement notwendig*/

            if($breakfast == 1){
                $breakfast = 1;
            }
            else if($breakfast == 2){
                $breakfast = 7;
            }/*da 7€/Nacht der Preis für Frühstück ist, kann es so später einfach berechnet werden*/

            if($pet == NULL){
                $pet = 0;
            }
        
            //Statement ausführen
        $stmt2->execute();

        header("Location:profile.php");
        exit();
    }
}

/*War der Erstz für den Eintrag in die DB
    $reservation = [
        "room" => $room,
        "arrival" => $arrival,
        "departure" => $departure,
        "breakfast" => $breakfast,
        "parking" => $parking,
        "pet" => $pet,
        "special_requests" => $special_requests
    ];

    $_SESSION["reservierungen"][] = $reservation;
*/
?>
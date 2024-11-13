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
    if (isset($_SESSION["pet1"])) {
        $pet += $_SESSION["pet1"];
    }
    if (isset($_SESSION["pet2"])) {
        $pet += $_SESSION["pet2"];
    }
    if (isset($_SESSION["pet3"])) {
        $pet += $_SESSION["pet1"];
    }
    $_SESSION["pet"] = htmlspecialchars($pet);
    
    $_SESSION["error_reservation"] = 0;
    /*0=kein Error, 
    1=Eine Eingabe ist leer, 
    2=room falsches format or existiert nicht, 
    4=arrival/departure wrong format,
    8=room not available
    16=pet currently not allowed
    32=no parking free*/

    if((empty($room))
    || (empty($arrival))
    || (empty($departure))
    || (empty($breakfast))
    || (empty($parking))
    || (empty($special_requests))
    || (empty($pet))
    ){
        $_SESSION["error_reservation"] += 1;
    }

}

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


header("Location:profile.php");
exit();
?>
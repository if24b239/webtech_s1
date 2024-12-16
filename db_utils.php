<?php



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

function db_login_check($username, $password) {

    $sql = $mysqli->prepare("SELECT username, passwort
        FROM person
        WHERE username = ?
        AND passwort = ?;");

    $sql->bind_param("ss", $username, $password); // TODO: MAKE SURE ITS INJECTION SAFE

    $sql->execute();

    $result = $sql->get_result(); 
    
    if ($result) {
        return true;
    }

    return false;
}

?>
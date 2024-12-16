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

function db_conn_check() {
    
    global $db
    
    if ($db) {
        return;
    }
    
    db_connect();
}

function db_login_check($username, $password) {
    global $db;
    db_conn_check();

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

function db_registration_check() {
    global $db;
    db_conn_check();
}

function db_registration_add() {
    global $db;
    db_conn_check();
}

function db_news_get() {
    global $db;
    db_conn_check();
}

function db_news_add() {
    global $db;
    db_conn_check();
}

?>
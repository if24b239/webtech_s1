<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //DB AUFBAU
        include 'db_utils.php';
        db_conn_check();
    
    //Lösch-Statement
        $sql="DELETE FROM newsbeitrag WHERE Beitrags_ID = ?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $_POST["beitrags_ID"]);
        $stmt->execute();

        header("Location:news.php");
        exit();
    }



    //
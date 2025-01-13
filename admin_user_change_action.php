<?php 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //variablen
    $vorname = htmlspecialchars($_POST["first_name"]);
    $nachname = htmlspecialchars($_POST["second_name"]);
    $email = htmlspecialchars($_POST["email"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $username = htmlspecialchars($_POST["user_name"]);
    $password = htmlspecialchars($_POST["password"]);
    $status = intval(htmlspecialchars($_POST["status"]));
    $userid = htmlspecialchars($_POST["user_id"]);

    echo $status;

    $_SESSION["error_user_change"] = 0;
    /*
    0= kein fehler
    1= eine eingabe leer
    */

    // error checks
    if(empty($vorname)||empty($nachname)||empty($email)||empty($gender)||empty($username)||empty($userid)|| $status > 1 || $status < 0){
        $_SESSION["error_user_change"] += 1;
    }

    // exit if an error has been found
    if ($_SESSION["error_user_change"]>0) {        
        header("Loaction:admin_user_administration.php");
        exit();
    }



    include 'db_utils.php';
    db_conn_check();

    $sql = "UPDATE person
    SET vorname = ?, 
        nachname = ?, 
        E_Mail = ?,
        Gender = ?,
        username = ?,
        active = ?
    WHERE Person_ID = " . $userid . ";
    ";

    $stmt = $db->prepare($sql);

    $stmt->bind_param("sssssi", $vorname, $nachname, $email, $gender, $username, $status);

    if (!$stmt->execute()) {
        die("Error executing query: " . $stmt->error);
    }

    //password change
    if (!empty($password)) {
        
        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE person
        SET passwort = ?
        WHERE Person_ID = ". $userid .";";

        $pw_stmt = $db->prepare($sql);

        $pw_stmt->bind_param("s", $hashedpassword);
        
        if (!$pw_stmt->execute()) {
            die("Error executing password query: " . $pw_stmt->error);
        }
    }
    
    header("Location:admin_user_administration.php");
    exit();
}
?>
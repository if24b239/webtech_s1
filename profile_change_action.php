<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      ///////////////////RÜCKMELDUNG ERFOLGREICHE ÄNDERUNG//////////////////
      if($_POST["form"]=='password_changed'){
        $_SESSION["profile_change"] = 0;
        header("Location:profile.php");
        exit();
      }

      ////////////////////////////////////////////////////////////////////////////
      ///////////////////////PROFILDATENÄNDERUNG//////////////////////////////////
      ////////////////////////////////////////////////////////////////////////////
      if($_POST["form"]=='change_profile'){
        $first_name = htmlspecialchars($_POST["first_name"]);
        $last_name = htmlspecialchars($_POST["last_name"]);
        $email = htmlspecialchars($_POST["email"]);
        $user = htmlspecialchars($_POST["user"]);
        $gender = htmlspecialchars($_POST["gender"]);
    
        /*
          echo'
            DEBUGGING 
            Anrede: '. $gender .', 
            Vorname: '.$first_name.', 
            Nachname: '. $last_name.', 
            Email: '. $email .', 
            username: '. $user .', 
          ';
        */
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////|Serverseitige Validierung - Profildaten|//////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $_SESSION["error_profile_change"]=0; 
          /*0=kein Error, 
          1= Ein Eintrag ist leer
          2=
          4=Nachname enthält invalide zeichen, 
          8=Vorname enthält invailde zeichen, 
          16=E-Mail enthält invailde zeichen
          32=Gender ist nicht eine der optionen
          64=
          */
        if((empty($first_name))
          || (empty($last_name))
          || (empty($email))
          || (empty($user))
          || (empty($gender))
        ){
            $_SESSION["error_profile_change"] += 1; 
        }
        if (!empty($last_name)&&(!preg_match('/^[-a-zA-Z[:space:]äöüÄÖÜ_]+$/', $last_name))){
            $_SESSION["error_profile_change"] += 4; 
        }
        if (!empty($first_name)&&(!preg_match('/^[-a-zA-Z[:space:]äöüÄÖÜ_]+$/', $first_name))){
          $_SESSION["error_profile_change"] += 8;
        }
        if (!empty($email)&&(!filter_var($email, FILTER_VALIDATE_EMAIL))){ 
          $_SESSION["error_profile_change"] += 16; 
        }
        if (!($gender == "female" || $gender == "male" || $gender == "other")) {
          $_SESSION["error_profile_change"] += 32;
        }

        if($_SESSION["error_profile_change"] != 0){
          header("Location:profile.php");
          exit();
        }

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////|DATENBANKEINTRAG - Profildaten|////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Datenbankverbindungaufbauen 
          include 'db_utils.php';
          db_conn_check();
        //SQL-Statement erstellen 
          $sql = "UPDATE person
                  SET vorname = ?, 
                      nachname = ?, 
                      E_Mail = ?,
                      Gender = ?,
                      username = ?
                  WHERE Person_ID = " . $_SESSION['ID'] . ";
                  ";
              
        //SQL-Statement „vorbereiten” 
          $stmt = $db->prepare($sql);
        //Parameter binden
          $stmt-> bind_param("sssss", $first_name, $last_name, $email, $gender, $user);
        //VariablenmitWerteversehen 
          /*oben schon alle festgelegt*/
        //Statement ausführen
          $stmt->execute(); 
          
        $_SESSION["profile_change"] = 1;
        header("Location:profile.php");
        exit();
  }


  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////|PASSWORT ÄNDERN|///////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if($_POST["form"]=='change_password'){

    $old_password = htmlspecialchars($_POST["old_password"]);
    $new_password = htmlspecialchars($_POST["new_password"]);
    $hashed_old_password = password_hash($old_password, PASSWORD_DEFAULT); 
    /*password_DB holen*/
      include 'db_utils.php';
      db_conn_check();
      $sql ="SELECT Passwort FROM person WHERE Person_ID = " . $_SESSION['ID'] . ";";
      $result = $db->query($sql);
      $row = $result->fetch_assoc();
    $db_password = $row['Passwort'];
    
   /*
    echo'
      DEBUGGING: 
      <br> old password: '. $old_password .', 
      <br> new password: '.$new_password.',
      <br> db passwort: '.$db_password.',
      <br> old hashed passwort: '.$hashed_old_password.'
    ';
    die();
    */

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////|Serverseitige Validierung - Passwort|//////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $_SESSION["error_password_change"]=0; 
          /*0=kein Error, 
          1= Passwort entspricht nicht den Anforderungen
          2= Altes Passwort stimmt nicht mit dem aus der DB überein
          4= Eine Eingabe ist leer
          8=
          */
    
    if (strlen($new_password) <= '8'
          ||!preg_match("#[a-z]+#",$new_password)
          ||!preg_match("#[A-Z]+#",$new_password)
          ||!preg_match("#[0-9]+#",$new_password)
          ){
          $_SESSION["error_password_change"] += 1;
    }
    if(!password_verify($old_password, $db_password)){
      $_SESSION["error_password_change"] += 2; 
    }
    if(empty($old_password)||empty($new_password)){
      $_SESSION["error_password_change"] += 4;
    }
    if($_SESSION["error_password_change"] != 0){
      header("Location:profile.php");
      exit();
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////|DATENBANKEINTRAG - Passwort|///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    if($_SESSION["error_password_change"] == 0){
      //Datenbankverbindungaufbauen 
        /*Wurde oben schon erledigt?*/ 

      //SQL-Statement erstellen 
        $sql2 = "UPDATE person 
                  SET passwort = ?
                  WHERE Person_ID = " . $_SESSION['ID'] . "
                ";

      //SQL-Statement „vorbereiten” 
        $stmt2 = $db->prepare($sql2);

      //Parameter binden
        $stmt2-> bind_param("s", $hashed_new_password);
      
      //VariablenmitWerteversehen 
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

      //Statement ausführen
        $stmt2->execute();  

      $_SESSION["profile_change"] = 2;

      header("Location:profile.php");
      exit();
    }
  }
}
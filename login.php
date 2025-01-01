<?php

    session_start();

    if(!isset($_SESSION["user_name"])){
       $_SESSION["user_name"]='';
    }
    if (!isset($_SESSION["error_login"])) {
        $_SESSION["error_login"] = 0;
        $_SESSION["log_user"] = '';
    }
?>

<!--TO-DOS
    -Daten sollten im Formular bleiben bei Fehlern.
    -required nach Debugging wieder hinzufügen.
-->

<!DOCTYPE html>
<html lang="de">

<?php $title = "Login"; include 'php_inserts\head.php';

   /* echo 'Debugging: error_login: '.$_SESSION["error_login"].''; */
?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section class="flex">
        <div>
            <form class="col-12 bordered" action="login_action_db.php" method="POST"> <!--Daten werden an login_action_db.php geschickt mit der Methode Post-->
                <h2>Login</h2>
                <div class="col-12">
                    <?php /*Fehlermeldung leere Eingabe*/
                        if($_SESSION["error_login"] & 1){
                            echo '<p class="warning">bitte alle Felder ausfüllen</p>';
                        }
                    ?>
                    <label id="user_name_login" for="user_name_login">Username:</label><br>
                    <input type="text" name="user_name_login" id="user_name_login" value="<?php echo''.$_SESSION["log_user"].'';?>" required> 
                </div>
                <div class="col-12">
                    <label id="password_login" for="password_login">Passwort:</label><br>
                    <input type="password" name="password_login" id="password_login" required>
                </div>
                <?php /*Fehlermeldung Benutzername und Passwort nicht in einem Datensatz in DB*/
                    if($_SESSION["error_login"] & 2){
                        echo '<p class="warning">Benutzername oder Passwort falsch</p>';
                    }
                ?>
                <br>
                <div class="col-12">
                    <button type="submit">Einloggen</button>
                </div>
            </form>
        </div>
    </section>
    <?php
        echo 'Username: MaxMustermann <br>';
        echo 'Passwort: Password_1234 <br><br>';  
        
        echo 'Username: AdMina <br>';
        echo 'Passwort: Admina_12 <br>';
    ?>
    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
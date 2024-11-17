<?php

    session_start();
    $static_password ='Password_1234';
    if(!isset($_SESSION["user_name"])){
       $_SESSION["user_name"]='';
    }
    if (!isset($_SESSION["error_login"])) {
        $_SESSION["error_login"] = 0;
    }
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Login"; include 'php_inserts\head.php';

   /* echo 'Debugging: error_login: '.$_SESSION["error_login"].''; */
?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <?php
        echo 'Username: MaxMustermann <br>';
        echo 'Passwort: '.$static_password.'<br>';
    ?>

    <section>
        <form class="col-12" action="login_action.php" method="Post"> <!--Daten werden an login_action.php geschickt mit der Methode Post-->
            <h2>Login</h2>
            <div class="col-12">
                <?php
                    if($_SESSION["error_login"] & 1){
                        echo '<p class="warning">bitte alle Felder ausfüllen</p>';
                    }
                ?>
                <label id="user_name_login" for="user_name_login">Username:</label><br>
                <input type="text" name="user_name_login" id="user_name_login" required>
            </div>
            <?php
                if($_SESSION["error_login"] & 4){
                    echo '<p class="warning">User Name stimmt nicht</p>';
                }
            ?>
            <div class="col-12">
                <label id="password_login" for="password_login">Passwort:</label><br>
                <input type="password" name="password_login" id="password_login" required>
            </div>
            <?php
                if($_SESSION["error_login"] & 2){
                    echo '<p class="warning">falsches Passwort</p>';
                }
            ?>
            <br>
            <div class="col-12">
                <button type="submit">Einloggen</button>
            </div>
        </form>
    </section>
   
    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
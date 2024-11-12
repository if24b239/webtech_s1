<?php

    session_start();
    $_SESSION["static_password"] ='Password_1234';
    if(!isset($_SESSION["wrong_password"])){
       $_SESSION["wrong_password"]=0;
    }
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Login"; include 'php_inserts\head.php';

    echo 'Debugging: wrong_password: '.$_SESSION["wrong_password"].'';
    echo '    Korrektes Passwort: '.$_SESSION["static_password"].'';

?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section>
        <form class="col-12" action="login_action.php" method="Post"> <!--Daten werden an login_action.php geschickt mit der Methode Post-->
            <h2>Login</h2>
            <div class="col-12">
                <label id="user_name_login" for="user_name_login">Username:</label><br>
                <input type="text" name="user_name_login" id="user_name_login" required>
            </div>
            <div class="col-12">
                <label id="password_login" for="password_login">Passwort:</label><br>
                <input type="password" name="password_login" id="password_login" required>
            </div>
            <?php
                if($_SESSION["wrong_password"]==1){
                    echo 'falsches Passwort';
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
<?php

    session_start();
    if(!isset($_SESSION["error_registration"])){
        $_SESSION["error_registration"]= 0;
    }

?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Registrierung"; include 'php_inserts\head.php'; 
    //Ausgabe wenn Passwörter nicht gleich sind

    /*Test*/ echo 'Debugging: Status error_registration: '.$_SESSION["error_registration"].'';
?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section>
        <form class="col-12" action="registration_action.php" method="POST">
            <h2>Registrierung</h2>
            <?php 
                if($_SESSION["error_registration"] & 1){
                    echo 'Bitte alle Felder ausfüllen!';
                }
            ?>
            <div class="col-4">
                <label id="gender" for="gender">Anrede</label><br>
                <select for="gender" id="gender" name="gender">
                    <option value="female">Frau</option>
                    <option value="male">Herr</option>
                    <option value="other">Vorname Nachname</option>
                </select>
                <?php 
                    if($_SESSION["error_registration"] & 32) {
                        echo 'Nur Frau, Mann oder Other';
                    }
                ?>
            </div>
            <div class="col-4">
                <label id="first_name" for="first_name">Vorname:</label><br>
                <input type="text" name="first_name" id="first_name" required>
                <?php 
                    if($_SESSION["error_registration"] & 8){
                        echo 'Der Vorname darf nur Buchstaben, Leerzeichen und Bindestriche enthalten.';
                    }
                ?>
            </div>
            <div class="col-4">
                <label id="last_name" for="last_name">Nachname:</label><br>
                <input type="text" name="last_name" id="last_name" required>
                <?php 
                    if($_SESSION["error_registration"] & 4){
                        echo 'Der Nachname darf nur Buchstaben, Leerzeichen und Bindestriche enthalten.';
                    }
                ?>
            </div>
            <div class="col-4">
                <label id="email">E-Mail Adresse:</label><br>
                <input type="email" name="email" id="email" required> 
                <?php 
                    if($_SESSION["error_registration"] & 16){
                        echo 'Die E-Mailadresse ist nicht valide!';
                    }
                ?>
            </div>
            <div class="col-4">
                <label id="user_name_registration" for="user_name_registration">Username:</label><br>
                <input type="text" name="user_name_registration" id="user_name_registration" required>
            </div>
            <div class="col-4">
                <label id="password" for="password">Passwort:</label><br>
                <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                <?php
                    if ($_SESSION["error_registration"] & 64) {
                        /* Erst Freigeben wenn Abfrage in registration_action funktioniert.*/
                        /*echo 'Das Passwort muss mindestes 1 Kleinbuchtsaben, 1 Großbuchstaben und eine Zahl enthalen.';*/
                    }
                ?>
            </div>
            <div class="col-4">
                <label id="password_repitition" for="password_repitition">Passwortwiederholung:</label><br>
                <input type="password" name="password_repitition" id="password_repitition" required>
                <?php 
                    if ($_SESSION["error_registration"] & 2) {
                        echo 'Passwörter stimmen nicht überein.';
                    }
                ?>
            </div>
            <br>
            <div class="col-12">
                <button type="submit">Bestätigen</button>
            </div>

        </form>
    </section>

    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
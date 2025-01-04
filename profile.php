<?php
    session_start();  

?>

<!DOCTYPE html>
<html lang="de">

<!-- 
Bewertungsmatrix:
        -> Profildaten aus der DB ausgeben und nicht über die Session,
        damit sie nach einer Änderung gleich korrekt angegeben werden. 
-->

<?php $title = "Profilverwaltung"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section class="flex">
        
        <h1> Profil und Reservierungsverwaltung </h1>
        <br>
        <?php
            if(isset($_SESSION["profile_change"])){
                if($_SESSION["profile_change"] == 2){
                    echo'
                        Passwort erfolgreich geändert!
                        <form action="profile_change_action.php" method="POST">
                            <input type="hidden" name="form" value="password_changed">
                            <button type="submit">Ok!</button>
                        </form>
                    ';
                }
                if($_SESSION["profile_change"] == 1){
                    echo'
                        Profildaten erfolgreich geändert!
                        Änderungen nach erneutem Einloggen sichtbar
                        <form action="profile_change_action.php" method="POST">
                            <input type="hidden" name="form" value="password_changed">
                            <button type="submit">Ok!</button>
                        </form>
                    ';
                }
            }
        ?>
        <div class="halfScreen">
            <div class="col-8" style="border: var(--accent-color); border-style: double;"">
                <h2>Reservierungsdetails</h2>
                <br>
                
            <?php
////////////////////////////////////////////////////////////////
///////////////////AUSGABE DER RESERVIERUNGEN///////////////////
////////////////////////////////////////////////////////////////

                if (isset($_SESSION["admin"])&&($_SESSION["admin"]!=NULL)) {

                    include 'profile_reservierungsdetails_admin.php';

                } else {

                    include 'profile_reservierungsdetails_user.php';

                }

                
            ?>
            </div>

<?php
////////////////////////////////////////////////////////////////
///////////////////AUSGABE DER PROFILDATEN//////////////////////
////////////////////////////////////////////////////////////////
?>
            
            <div class="col-4" style="border: var(--accent-color); border-style: double;">
                <h2>Profildaten</h2>

                    <div>
                        <div class="col-12">
                            <?php
                                echo'
                                Anrede: ';
                                if($_SESSION["gender"]== "female"){
                                    echo'Frau';
                                }
                                if($_SESSION["gender"]=='male'){
                                    echo'Herr';
                                }
                                if($_SESSION["gender"]=='other'){
                                    echo'Vorname Nachname';
                                }
                                echo'
                                    <br>
                                    <br>
                                    Vorname:  '.$_SESSION["first_name"].'
                                ';
                                echo'
                                    <br>
                                    <br>
                                    Nachname:  '.$_SESSION["last_name"].'
                                ';
                                    echo'
                                        <br>
                                        <br>
                                        Username:  '.$_SESSION["user"].'
                                    ';
                                echo'
                                    <br>
                                    <br>
                                    E-Mail Adresse:  '.$_SESSION["email"].'
                                ';
                            ?>
                        <br>
                        <br>
                        </div>   
                    </div>
                    <hr>
                    <br>  
                    <div>
                        <h2>Profildaten ändern</h2>
                        <details class="profile_change">
                            <summary>Formular öffnen</summary>
                            <br>
                            <form class="col-12" action="profile_change_action.php" method="POST">
                                <select for="gender" id="gender" name="gender">
                                    <option <?php if($_SESSION["gender"]== "female"){echo'selected="selected"';}?> value="female">Frau</option>
                                    <option <?php if($_SESSION["gender"]== "male"){echo'selected="selected"';}?> value="male">Herr</option>
                                    <option <?php if($_SESSION["gender"]== "other"){echo'selected="selected"';}?>value="other">Vorname Nachname</option>
                                </select>
                                <br>
                                <input type="hidden" name="form" value="change_profile"><!--Über diese Variable wird auf profile_change_action.php entschieden welches Formular ausgewertet wird.-->
                                <input type="text" name="first_name" id="first_name" value="<?php echo''.$_SESSION["first_name"].'';?>">
                                <br>
                                <input type="text" name="last_name" id="last_name" value="<?php echo''.$_SESSION["last_name"].'';?>">
                                <br>
                                <input type="text" name="user" id="user" value="<?php echo''.$_SESSION["user"].'';?>">
                                <br>
                                <input type="text" name="email" id="email" value="<?php echo''.$_SESSION["email"].'';?>">
                                <br>
                                <br>
                                <button type="submit">Profildaten ändern</button>
                            </form>
                                
                            <form class="col-12" action="profile_change_action.php" method="POST">
                                <input type="hidden" name="form" value="change_password"><!--Über diese Variable wird auf profile_change_action.php entschieden welches Formular ausgewertet wird.-->
                                <input type="password" name="new_password" id="new_password" placeholder="neues Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                <br>
                                <input type="password" name="old_password" id="old_password" placeholder="altes Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                <br>
                                <?php
                                    if(isset($_SESSION["error_password_change"])){
                                        if($_SESSION["error_password_change"] & 1){
                                            echo'<p class="warning">Das Passwort muss mindestes 1 Kleinbuchtsaben, 1 Großbuchstaben und eine Zahl enthalen.</p>';
                                        }
                                        if($_SESSION["error_password_change"] & 2){
                                            echo'<p class="warning">altes Passwort falsch.</p>';
                                        }
                                        if($_SESSION["error_password_change"] & 4){
                                            echo'<p class="warning">Alle Felder müssen ausgefüllt werden.</p>';
                                        }
                                    }
                                ?>
                                <br>
                                <button type="submit">Passwort ändern</button>
                            </form>

                        </details>
                    </div>
            </div>        
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
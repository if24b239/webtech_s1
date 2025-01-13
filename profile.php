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
                // error ausgabe
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
                        <form action="profile_change_action.php" method="POST">
                            <input type="hidden" name="form" value="password_changed">
                            <button type="submit">Ok!</button>
                        </form>
                    ';
                }
            }
            // success ausgsabe
            if(isset($_SESSION["reservation_ok"])){
                if($_SESSION["reservation_ok"] == 1){
                    echo'
                        <p>Reservierung erfolgreich angelegt!</p>
                        <p>Eine unserer MitarbeiterInnen wird die Reservierung in kürze bestätigen.</p>
                        <p>der Status der Reservierung wird dann von "neu" auf "bestätigt" geändert</p>
                        <form action="profile_change_action.php" method="POST">
                            <input type="hidden" name="form" value="reservation_ok">
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

                    <?php db_userinformation_profile(); /*Funktion gibt die Profildaten der eingeloggten Userin aus*/?>                 
                    <hr>
                    <br>  
                    <div>
<?php
////////////////////////////////////////////////////////////////
/////////////////////PROFILDATEN ÄNDERN ////////////////////////
////////////////////////////////////////////////////////////////
?>
                        <h2>Profildaten ändern</h2>
                        <details class="profile_change">
                            <summary>Formular öffnen</summary>
                            <br>
                            <form class="col-12" action="profile_change_action.php" method="POST">
                                <label id="gender" for="gender">Anrede:</label><br>
                                <select for="gender" id="gender" name="gender">
                                    <option <?php if($_SESSION["gender"]== "female"){echo'selected="selected"';}?> value="female">Frau</option>
                                    <option <?php if($_SESSION["gender"]== "male"){echo'selected="selected"';}?> value="male">Herr</option>
                                    <option <?php if($_SESSION["gender"]== "other"){echo'selected="selected"';}?>value="other">Vorname Nachname</option>
                                </select>
                                <br>
                                <input type="hidden" name="form" value="change_profile"><!--Über diese Variable wird auf profile_change_action.php entschieden welches Formular ausgewertet wird.-->
                                <label id="first_name" for="first_name">Vorname:</label><br>
                                <input type="text" name="first_name" id="first_name" value="<?php echo''.$_SESSION["first_name"].'';?>" required>
                                <br>
                                <label id="last_name" for="last_name">Nachname:</label><br>
                                <input type="text" name="last_name" id="last_name" value="<?php echo''.$_SESSION["last_name"].'';?>" required>
                                <br>
                                <label id="user" for="user">Username:</label><br>
                                <input type="text" name="user" id="user" value="<?php echo''.$_SESSION["user"].'';?>" required>
                                <br>
                                <label id="email" for="email">E-Mail:</label><br>
                                <input type="text" name="email" id="email" value="<?php echo''.$_SESSION["email"].'';?>" required>
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
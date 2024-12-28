<?php
    session_start();  

?>

<!DOCTYPE html>
<html lang="de">

<!-- 
Bewertungsmatrix:
    a) eingeloggte User können Profildaten einsehen und bearbeiten 
    b) Passwörter werden nicht angezeigt und beim Ändern des Passwortes muss das alte PW eingegeben werden 
-->

<?php $title = "Profilverwaltung"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section class="flex">
        
        <h1> Profil und Reservierungsverwaltung </h1>
        <br>
        <div class="halfScreen">
            <div class="halfScreenChild test1">
                <h1>Reservierungsdetails</h1>
                
            <!--AUSGABE DER RESERVIERUNGEN -->

            <!--SQL Abfrage über alle Reservierungen mit der person ID der eingeloggten Person-->
            <p>Alle reservierungen ausgeben sobald neue angelegt werden können</p>
            <!-- -->

            <!-- -->
            
            </div>
            
            <div class="halfScreenChild right test2" style="border: var(--accent-color); border-style: double;">
                <h1>Profildaten</h1>

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
                    <br>  
                    <div>
                        <h1>Profildaten ändern</h1>
                        <details class="profile_change">
                            <summary>Formular öffnen</summary>
                            <br>
                            <form class="col-4" action="profile_change_action.php" method="POST">
                                <select for="gender" id="gender" name="gender">
                                    <option <?php if($_SESSION["gender"]== "female"){echo'selected="selected"';}?> value="female">Frau</option>
                                    <option <?php if($_SESSION["gender"]== "male"){echo'selected="selected"';}?> value="male">Herr</option>
                                    <option <?php if($_SESSION["gender"]== "other"){echo'selected="selected"';}?>value="other">Vorname Nachname</option>
                                </select>
                                <br>
                                <input type="text" name="first_name" id="first_name" placeholder="<?php echo''.$_SESSION["first_name"].'';?>">
                                <br>
                                <input type="text" name="last_name" id="last_name" placeholder="<?php echo''.$_SESSION["last_name"].'';?>">
                                <br>
                                <input type="text" name="user" id="user" placeholder="<?php echo''.$_SESSION["user"].'';?>">
                                <br>
                                <input type="text" name="email" id="email" placeholder="<?php echo''.$_SESSION["email"].'';?>">
                                <br>
                                <input type="new_password" name="new_password" id="new_password" placeholder="neues Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                <br>
                                <input type="old_password" name="old_password" id="old_password" placeholder="altes Passwort" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                <br>
                                <br>
                                <button type="submit">Bestätigen</button>
                            </form>
                        </details>
                    </div>
            </div>        
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
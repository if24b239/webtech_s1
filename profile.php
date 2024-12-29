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
            }
        ?>
        <div class="halfScreen">
            <div class="col-8" style="border: var(--accent-color); border-style: double;"">
                <h1>Reservierungsdetails</h1>
                <br>
                
 
            <?php
////////////////////////////////////////////////////////////////
///////////////////AUSGABE DER RESERVIERUNGEN///////////////////
////////////////////////////////////////////////////////////////

                //SQL Abfrage über alle Reservierungen mit der person ID der eingeloggten Person
                db_conn_check();

                $sql = "SELECT  date_format(Abreisedatum, '%d.%m.%Y') AS 'Abreisedatum',
                                date_format(Anreisedatum, '%d.%m.%Y') AS 'Anreisedatum', 
                                r.Fruehstueck, r.Parkplatz, r.Haustier, r.FK_Zimmer_ID, r.status, r.Sonderwuensche, 
                               (DATEDIFF(Abreisedatum, Anreisedatum)*z.PreisProNacht) AS 'GesammtpreisOhneZulagen',
                               (DATEDIFF(Abreisedatum, Anreisedatum)*r.Fruehstueck) AS 'ZuschlagFruechstueck',
                               (DATEDIFF(Abreisedatum, Anreisedatum)*r.Haustier) AS 'ZuschlagTiere',
                               (DATEDIFF(Abreisedatum, Anreisedatum)*r.Parkplatz) AS 'ZuschlagParkplatz',
                                ((DATEDIFF(Abreisedatum, Anreisedatum)*z.PreisProNacht)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Fruehstueck)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Parkplatz)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Haustier)) AS 'GesammtpreisMitZulagen'        
                        FROM reservierung r JOIN zimmer z
                            ON r.FK_Zimmer_ID = z.Zimmer_ID
                        WHERE FK_KundInnen_ID = " . $_SESSION['ID'] . " 
                        ";
                $result = $db->query($sql);

                //Alle Einträge ausgeben
                while ($row = $result->fetch_array()) {
                    echo'
                        <hr>
                        <p style="font-weight: bold;"> Reservierung vom ' . $row['Anreisedatum'] . ' bis ' . $row['Abreisedatum'] . '</p>
                        Raumtyp: ';
                        if($row['FK_Zimmer_ID'] == 1){
                            echo'A';
                        }
                        if($row['FK_Zimmer_ID'] == 2){
                            echo'B';
                        }
                    echo'
                        <br> 
                        Gesammtpreis ohne Zuschlägen: ' . $row['GesammtpreisOhneZulagen'] . ' €
                    ';
                    echo'
                        <br>
                    ';
                        if($row['Fruehstueck'] == 1){
                            echo'Ohne Frühstück';
                        }
                        if($row['Fruehstueck'] > 2){
                            echo'Mit Frühstück / Zuschlag: '.$row['ZuschlagFruechstueck'].'€';
                        }

                    echo'
                        <br>
                        Haustiere:
                    ';
                        if($row['Haustier'] < 1){
                            echo'keine Tiere kommen mit';
                        }
                        if($row['Haustier'] > 1){
                            if($row['Haustier'] & 4){
                                echo' Pferd / ';
                            }
                            if($row['Haustier'] & 2){
                                echo' Hund / ';
                            }
                            if($row['Haustier'] & 8){
                                echo' Chimäre / ';
                            }
                            echo'Gesammtzuschlag Haustiere: '.$row['ZuschlagTiere'].'€ ';
                        }
                    echo'
                        <br>
                    ';
                        if($row['Parkplatz'] == 1){
                            echo'ohne Parkplatz';
                        }
                        if($row['Parkplatz'] == 2){
                            echo'mit Parkplatz / Zuschlag: '.$row['ZuschlagParkplatz'].'€  ';
                        }
                    echo'   
                        <br>
                        Anmerkungen: ' . $row['Sonderwuensche'] . '        
                    ';
                    echo'
                        <br>
                        Gesammtpreis mit Zuschlägen: ' . $row['GesammtpreisMitZulagen'] . ' €
                    ';
                    echo'
                        <br>
                        Status: ' . $row['status'] . '
                    ';

                    echo'
             
                        <br>
                        <br>

                    ';
                }
            ?>
            </div>

<?php
////////////////////////////////////////////////////////////////
///////////////////AUSGABE DER PROFILDATEN//////////////////////
////////////////////////////////////////////////////////////////
?>
            
            <div class="col-4" style="border: var(--accent-color); border-style: double;">
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
                    <hr>
                    <br>  
                    <div>
                        <h1>Profildaten ändern</h1>
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
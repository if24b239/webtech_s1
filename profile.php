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
                <?php 
                if (isset($_SESSION["reservierungen"])) {
                    foreach ($_SESSION["reservierungen"] as $x) {
                        echo '
                            <div class="bordered">
                                <p>Reservierung vom '.$x["arrival"].' bis zum '.$x["departure"].':</p>  
                                <br>
                                <p>gewähltes Zimmer: <br>'.$x["room"].'</p>
                                <br>
                                <p>Frühstück: </p>
                        ';
                        if($x["breakfast"]=='with_breakfast'){
                            echo 'mit Frühstück
                                <br>
                            ';
                        }
                        else if ($x["breakfast"]=='without_breakfast'){
                            echo 'ohne Frühstück
                                <br>
                            ';
                        }
                        echo '
                            <br>
                            <p>Parkplatz: </p> 
                        ';
                        if($x["parking"]=='with_parking'){
                            echo 'mit Parkplatz
                                <br>
                            ';
                        }
                        else if ($x["parking"]=='without_parking'){
                            echo 'ohne Parkplatz
                                <br>
                            ';
                        }

                        echo '
                            <br>
                            <p>welche Haustiere kommen mit?</p> 
                        ';
                        if($x["pet"] & 1){
                            echo '
                                <p>Pferd</p>
                            ';
                        }
                        if($x["pet"] & 2){
                            echo '
                                <p>Hund</p>
                            ';
                        }
                        if($x["pet"] & 4){
                            echo '
                            <p>Chimäre</p>
                            ';
                        }

                        echo '
                            <br>
                            <p>Anmerkungen: <br>'.$x["special_requests"].'</p>
                            <br>
                        
                            </div>
                        ';
                        
                    }
                }
                ?>
            </div>
            
            <div class="halfScreenChild right test2">
                <h1>Profildaten</h1>

                    <div class="bordered">
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
                        <!--
                        <br>
                            <br>
                            <details style="border-style: groove;">
                                <summary> Profildaten ändern - noch nicht formatiert oder funktionable </summary>
                                <form style="display: flex" action="profile_change_action.php" method="Post">
                                    <div style="width: 100%">
                                        <label id="" for="">neuer Vorname:</label><br>
                                        <input type="text" " id="">
                                    </div>
                                        <br>
                                    <div>
                                        <label id="" for="">neuer Nachname:</label><br>
                                        <input type="text" " id="">
                                    </div>
                                        <br>
                                    <div>
                                        <label id="" for="">neue E-Mailadresse:</label><br>
                                        <input type="text" " id="">
                                    </div>
                                        <br>
                                    <div>
                                        <label id="" for="">neuer Benutzername:</label><br>
                                        <input type="text" " id="">
                                    </div>
                                        <br>
                                    <div>
                                        <label id="" for="">neues Passwort:</label><br>
                                        <input type="text" " id="">
                                    </div>
                                        <br>
                                    <div>
                                        <label id="" for="">Passwortwiederholung:</label><br>
                                        <input type="text" " id="">
                                    </div>
                                        <br>
                                        <br>
                                        <button type="submit">Änderungen bestätigen</button>
                                </form>
                            </details>
                        
                            
                            <br>
                            <br>
                    -->
                        
                

                    </div>
            </div>
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
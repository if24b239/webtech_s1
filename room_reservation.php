<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        $_SESSION["logged_in"] = 0;
    }
    if (!isset($_SESSION["error_reservation"])) {
        $_SESSION["error_reservation"] = 0;
    }
?>
<!DOCTYPE html>
<html lang="de">

<!-- TO-Dos
    -Gesammtpreis der Reservierung anzeigen sowie Zuschläge durch Frühstück, Parkplatz und Tiere


-->

<?php $title = "Zimmerreservierung"; include 'php_inserts\head.php';?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
  <main class="main-reservation">
    <section>
  

        <?php echo'DEBUGGING: error_reservation: '.$_SESSION["error_reservation"].' '?>

        <form class="col-12 bordered" action="room_reservation_action.php" method="Post"> 
            <h2>Zimmerreservierung</h2>
            <br>
            <?php 
                if($_SESSION["error_reservation"] & 1){
                    echo'<p class="warning">Anreisedatum, Abreisedatum, Raumauswahl, Frühstückswahl und Parkplatzwahl sind notwendige Asuwahlen.</p>';
                }
            ?>
            <!--Raumwahl-->
            <div class="row">
                <div class="roomReservation_Rooms">
                    <div class="roomReservation_Rooms bordered">
                        <label id="room1" for="room1">
                            <p>Raum Typ A</p>
                            <input type="radio" name="room" id="room1" value="1">
                            <img src="pictures/sleepingChamber1.jpg" alt="Auswahl und Bild unseres Zimmers vom Typ A. Es enthält ein Doppelbett, einen Kleiderschrank und einen Schreibtisch.">
                            <p>Dieser Raum bietet Ihnen ein bequemes Doppelbett und einen großen Schreibtisch.</p>
                        </label>
                    </div>
                        <br>
                        <br>
                        <details class="profile_change">
                            <summary>Vergebene Zeiträume Typ-A</summary>
                            <p class="warning">Zeiträume ausgeben in denen der Raum reserviert ist</p>
                            
                        </details>
                    </div>  
                <div class="roomReservation_Rooms">
                    <div class="roomReservation_Rooms bordered">
                        <label id="room2" for="room2">
                            <p>Raum Typ B</p>
                            <input type="radio" name="room" id="room2" value="2">
                            <img src="pictures/sleepingChamber2.jpg" alt="Auswahl und Bild unseres Zimmers vom Typ B. Es enthält ein Doppelbett, einen Kleiderschrank und ein Bücherregal zur Unterhaltung.">
                            <p>Dieser Raum bietet Ihnen zusäzlich zum Doppelbett auch ein gut ausgestattetes Bücherregal.</p>
                        </label>
                    </div>
                        <br>
                        <br>
                        <details class="profile_change">
                            <summary>Vergebene Zeiträume Typ-A</summary>
                            <p class="warning">Zeiträume ausgeben in denen der Raum reserviert ist</p>
                            
                        </details>
                </div>
            </div>
            <br>
            <!--Reservierungszeitraum (An- und Abreisedatum, Abreisedatum darf nicht <= Anreisedatum sein)-->
            <div class="row">
                <div class="roomReservation_Rooms">
                    <label id="arrival"  for="arrival">Anreisedatum:</label><br>
                    <input type="date" name="arrival" id="arrival" required>
                </div>
                <br>
                <div class="roomReservation_Rooms">
                    <label id="departure"  for="departure">Abreisedatum:</label><br>
                    <input type="date" name="departure" id="departure" required>
                </div>
            </div>
            <?php
                    if($_SESSION["error_reservation"] & 64){
                        echo '
                            <p class="warning">Das Abreisedatum muss hinter dem Anreisedatum liegen.</p>
                            <br>
                        ';
                    }
                    if($_SESSION["error_reservation"] & 8){
                        echo'
                            <p class="warning">Leider ist das dieser Raum in dem Zeitraum bereits reserviert.</p>
                            <br>
                        ';
                    }
                
            ?>
            <br>
            <!--mit oder ohne Frühstück-->
            <div class="row">
                <div class="roomReservation_Rooms">
                    <label id="breakfast" for="breakfast">Frühstück:</label><br>
                    <select for="breakfast" id="breakfast" name="breakfast">
                        <option value="1">ohne Frühstück</option>
                        <option value="2">mit Frühstück (+7€/Nacht)</option>
                    </select>
                </div>
                <br>
                <!--mit oder ohne Parkplatz-->
                <div class="roomReservation_Rooms">
                    <label id="parking" for="parking">Parkplatz:</label><br>
                    <select for="parking" id="parking" name="parking">
                        <option value="1">ohne Parkplatz</option>
                        <option value="2">mit Parkplatz (+2€/Nacht)</option>
                    </select>
                </div>
            </div>
            <br>
            <!--Mitnahme von Haustieren (individuelle Ausgestaltung möglich)-->
            <div class="row">
                <div class="roomReservation_Rooms">
                    <p>Folgende Haustiere kommen mit: </p>
                    <input type="checkbox" id="pet1" name="pet1" value="1">
                    <label id="pet1" for="pet1">Pferd (+4€/Nacht)</label><br>
                    <input type="checkbox" id="pet2" name="pet2" value="2">
                    <label id="pet2" for="pet2">Hund (+2€/Nacht)</label><br>
                    <input type="checkbox" id="pet3" name="pet3" value="4">
                    <label id="pet3" for="pet3">Chimäre (+8€/Nacht)</label><br>
                </div>
                
                <div class="roomReservation_Rooms" style="max-width:285px;">
                    <label id="special_requests" for="special_requests">Gibt es etwas was wir beachten sollen?</label><br>
                    <textarea name="special_requests" id="special_request" style="min-width:285px; max-width:100%; min-height:85px;"></textarea>
                </div>
            </div>    
          <br>  
           <div class="row"> 
                <button type="submit">Reservierung abschließen</button>
            </div>
        </form>

    </section>
    </main>  
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
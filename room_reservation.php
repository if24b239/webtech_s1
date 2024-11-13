<?php
    session_start();
    if(!isset($_SESSION["user_name"])){
        $_SESSION["logged_in"] = 0;
    }
?>
<!DOCTYPE html>
<html lang="de">

<?php $title = "Zimmerreservierung"; include 'php_inserts\head.php';

echo '$_SESSION["user_name"]: '.$_SESSION["user_name"].'';

?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section>
        <!--If Abfrage wenn, noch nicht login: dort hin verweisen -->

        <!--If Abfrage wenn schon Login, Formular anzeigen -->
        <form class="col-12" action="room_reservation_action.php" method="Post"> 
            <h2>Zimmerreservierung</h2>
            <br>
            <!--Raumwahl-->
            <div>
                <div class="roomReservation_Rooms">
                    <label id="room1" for="room1">
                        <p>Raum Typ A</p>
                        <input type="radio" name="room" id="room1" value="room1">
                        <img src="pictures/sleepingChamber1.jpg" alt="Auswahl und Bild unseres Zimmers vom Typ A. Es enthält ein Doppelbett, einen Kleiderschrank und einen Schreibtisch.">
                        <p>Dieser Raum bietet Ihnen ein bequemes Doppelbett und einen großen Schreibtisch.</p>

                    </label>
                </div>
                <div class="roomReservation_Rooms">
                    <label id="room2" for="room2">
                        <p>Raum Typ B</p>
                        <input type="radio" name="room" id="room2" value="room2">
                        <img src="pictures/sleepingChamber2.jpg" alt="Auswahl und Bild unseres Zimmers vom Typ B. Es enthält ein Doppelbett, einen Kleiderschrank und ein Bücherregal zur Unterhaltung.">
                        <p>Dieser Raum bietet Ihnen zusäzlich zum Doppelbett auch ein gut ausgestattetes Bücherregal.</p>
                    </label>
                </div>
            </div>
            <br>
            <!--Reservierungszeitraum (An- und Abreisedatum, Abreisedatum darf nicht <= Anreisedatum sein)-->
            <div class="form-element">
                <label id="arrival"  for="arrival">Anreisedatum:</label><br>
                <input type="date" name="arrival" id="arrival" required>
            </div>
            <br>
            <div>
                <label id="departure"  for="departure">Anreisedatum:</label><br>
                <input type="date" name="departure" id="departure" required>
            </div>
            <br>

            <!--mit oder ohne Frühstück-->
            <div>
                <label id="breakfast" for="breakfast">Frühstück:</label><br>
                <select for="breakfast" id="breakfast" name="breakfast">
                    <option value="without_breakfast">ohne Frühstück</option>
                    <option value="with_breakfast">mit Frühstück (+7€/Nacht)</option>
                </select>
            </div>
            <br>
            <!--mit oder ohne Parkplatz-->
            <div>
                <label id="parking" for="parking">Parkplatz:</label><br>
                <select for="parking" id="parking" name="parking">
                    <option value="without_parking">ohne Parkplatz</option>
                    <option value="with_parking">mit Parkplatz (+2€/Nacht)</option>
                </select>
            </div>
            <br>
            <!--Mitnahme von Haustieren (individuelle Ausgestaltung möglich)-->
            <div>
                <p>Folgende Haustiere kommen mit: </p>
                <input type="checkbox" id="pet1" name="pet1" value="1">
                <label for="pet1">Pferd</label><br>
                <input type="checkbox" id="pet2" name="pet2" value="2">
                <label for="pet2">Hund</label><br>
                <input type="checkbox" id="pet3" name="pet3" value="4">
                <label for="pet3">Chimäre</label><br>
            </div>
            <br>
            <div>
                <label id="special_requests" for="special_requests">Gibt es etwas was wir beachten sollen?</label><br>
                <input type="text" name="special_requests" id="special_requests">
            </div>

            <br>
            <div>
                <button type="submit">Reservierung abschließen</button>
            </div>
        </form>

    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
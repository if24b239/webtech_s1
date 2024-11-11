<!DOCTYPE html>
<html lang="de">

<?php $title = "Zimmerreservierung"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section>
    <!--If Abfrage wenn, noch nicht login: dort hin verweisen -->

    <!--If Abfrage wenn schon Login, Formular anzeigen -->
    <form class="col-12" action="roomReservation_action.php" target="_blank" method="Post"> 
            <h2>Zimmerreservierung</h2>
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
                <input type="checkbox" id="pet1" name="pet1" value="horse">
                <label for="pet1">Pferd</label><br>
                <input type="checkbox" id="pet2" name="pet2" value="dog">
                <label for="pet2">Hund</label><br>
                <input type="checkbox" id="pet3" name="pet3" value="chimera">
                <label for="pet3">Chimäre</label><br>
            </div>
            <br>
            <div>
                <label id="special_requests" for="special_requests">Gibt es etwas was wir beachten sollen?</label><br>
                <input type="text" name="special_requests" id="special_requests">
            </div>

            <br>
            <div class=>
                <button type="submit">Reservierung abschließen</button>
            </div>
        </form>


    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
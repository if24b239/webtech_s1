<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "FAQ und Impressum"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section class="container-faq">
        <h1>FAQ's</h1>
        <br>
        <details style="border-style: groove;">
            <summary> Wie kann ich eine Reservierung vornehmen? </summary>
            <br>
            <p>Um eine Reservierung durchzuführen, müssen Sie 1. registriert und 2. eingeloggt sein. </p>
            <br>
            <p>Drücken Sie dann in der Navigationsleiste auf "Zimmerreservierung".</p>
            <p>Hier wählen Sie nun das von Ihnen gewünschte Zimmer sowie das An- und Abreisedatum aus.</p>
            <br>
            <p>Zusätzlich werden Sie noch nach Ihren Wünschen bezüglich Frühstück, Parkplatz und der Mitnahme von Haustieren gefragt.</p>
            <p>Außerdem gibt es dort die Möglichkeit besondere Wünsche anzumerken.</p>
            <br>
            <p>Wir freuen uns auf Ihren Besuch!</p>
        </details>
        <br>
        <details style="border-style: groove;">
            <summary> 2.FAQ</summary>
            <br>
            <p></p>
        </details>
        <br>
        <details style="border-style: groove;">
            <summary> 3. FAQ </summary>
            <p>Antwort auf die zweithäufigste Frage</p>
        </details>

    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
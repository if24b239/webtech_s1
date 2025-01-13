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
            <summary>Ich habe mein Passwort vergessen</summary>
            <br>
            <p>Bitte schreiben Sie unseren MitarbeiterInnen unter: zurGoldenenGans@office.com</p>
            <p>Unsere MitarbeiterInnen setzen sich dann mit Ihnen in Kontakt und legen Ihnen ein neues Passwort an.</p>
        </details>
        <br>
        <details style="border-style: groove;">
            <summary> Warum ist es so teuer meine Chimäre mitzunehmen? </summary>
            <br>
            <p>Neben den hohen Futterkosten müssen wir für die Chimären speziell angepasste Unterkünfte bereitstellen. 
                Die Stallungen und Gehege müssen nicht nur sicher und stabil sein, 
                sondern auch ausreichend Platz bieten, um den verschiedenen Teilen der Chimäre gerecht zu werden. 
                Ihre Reaktionsgeschwindigkeit und ihre Fähigkeit, zu entkommen oder Schaden anzurichten, 
                erfordern außerdem spezielle Sicherheitsvorkehrungen, 
                um sowohl das Hotelpersonal als auch die anderen Gäste zu schützen. </p>
              <br>
              <p>All diese Faktoren – von der Ernährung über die Unterbringung bis hin zur magischen Betreuung – 
                führen zu den hohen Kosten, die mit der Mitnahme einer Chimäre verbunden sind. 
                Aber keine Sorge: Unser Hotel sorgt dafür, 
                dass sowohl Sie als auch Ihre magischen Begleiter sich wie zu Hause fühlen!</p>  
        </details>

    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
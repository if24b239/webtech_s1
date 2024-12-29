<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Reservierungsverwaltung"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section> 
    <!--Alle Reservierungen nach nähestem Anreisedatum ausgeben -->
    <?php
        db_conn_check();

        $sql = "SELECT  date_format(Abreisedatum, '%d.%m.%Y') AS 'Abreisedatum',
                        date_format(Anreisedatum, '%d.%m.%Y') AS 'Anreisedatum', 
                        r.Fruehstueck, r.Parkplatz, r.Haustier, r.FK_Zimmer_ID, r.status, r.Sonderwuensche, r.Reservierungs_ID, 
                        (DATEDIFF(Abreisedatum, Anreisedatum)*z.PreisProNacht) AS 'GesammtpreisOhneZulagen',
                        (DATEDIFF(Abreisedatum, Anreisedatum)*r.Fruehstueck) AS 'ZuschlagFruechstueck',
                        (DATEDIFF(Abreisedatum, Anreisedatum)*r.Haustier) AS 'ZuschlagTiere',
                        (DATEDIFF(Abreisedatum, Anreisedatum)*r.Parkplatz) AS 'ZuschlagParkplatz',
                        ((DATEDIFF(Abreisedatum, Anreisedatum)*z.PreisProNacht)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Fruehstueck)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Parkplatz)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Haustier)) AS 'GesammtpreisMitZulagen',
                        p.vorname, p.nachname, p.E_Mail, p.gender
                FROM reservierung r JOIN zimmer z
                        ON r.FK_Zimmer_ID = z.Zimmer_ID
                    JOIN person p
                        ON r.FK_KundInnen_ID = p.Person_ID
                ORDER BY Anreisedatum asc;
                ";
        $result = $db->query($sql);

        while ($row = $result->fetch_array()) {
            echo'

                <details style="border-style: groove; border-color: var(--text-color);">
                    <summary> vom ' . $row['Anreisedatum'] . ' bis ' . $row['Abreisedatum'] . '
                             im ';
                                if($row['FK_Zimmer_ID'] == 1){
                                    echo'Sonnenraum';
                                }
                                if($row['FK_Zimmer_ID'] == 2){
                                    echo'Mondscheinzimmer';
                                }
                        echo' ID ' . $row['Reservierungs_ID'] . '
                    </summary>
                    <div style="border-style: dotted; border-color: var(--darker-background-color);">
                        <p>gebucht von    ' . $row['vorname'] . ' ' . $row['nachname'] . '</p>
                    </div>
                    <div style="border-style: dotted; border-color: var(--darker-background-color);">
                        <p>Preis ohne Zuschläge    ' . $row['GesammtpreisOhneZulagen'] . ' €</p>
                    </div>
                    <table style="width:100%">
                        <tr>
                            <td>Zuschläge</td>
                            <td>Frühstück</td>
                            <td>Parkplatz</td>
                            <td>Haustiere</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>';
                                if($row['Fruehstueck'] == 0){
                                    echo'Ohne Frühstück';
                                }
                                if($row['Fruehstueck'] > 2){
                                    echo'Mit Frühstück';
                                }
                            echo'
                            </td>
                            <td>';
                                if($row['Parkplatz'] == 1){
                                    echo'Ohne Parkplatz';
                                }
                                if($row['Parkplatz'] >= 2){
                                    echo'Mit Parkplatz';
                                }
                            echo'
                            </td>
                            <td>
                            ';
                                if($row['Haustier'] < 1){
                                    echo'keine Tiere kommen mit';
                                }
                                if($row['Haustier'] > 1){
                                    if($row['Haustier'] & 4){
                                        echo' Pferd ';
                                    }
                                    if($row['Haustier'] & 2){
                                        echo'| Hund  ';
                                    }
                                    if($row['Haustier'] & 8){
                                        echo'| Chimäre  ';
                                    }
                                }
                            echo'
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>' . $row['ZuschlagFruechstueck'] . '€</td>
                            <td>' . $row['ZuschlagParkplatz'] . '€</td>
                            <td>' . $row['ZuschlagTiere'] . '€</td>

                        </tr>
                    </table>
                    <div style="border-style: dotted; border-color: var(--darker-background-color);">
                        <p>Gesammtpreis    ' . $row['GesammtpreisMitZulagen'] . ' €</p>
                    </div>
                </details>
            <br>
            ';

        }

    ?>

    
    </section>
    <!--Status ändern über Reservierungs ID-->


    <!--User*Innenstatus in der DB anlegen und verändern können -->
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
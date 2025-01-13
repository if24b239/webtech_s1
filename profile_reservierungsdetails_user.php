<?php

//SQL Abfrage über alle Reservierungen mit der person ID der eingeloggten Person
db_conn_check();

$sql = "SELECT  date_format(Abreisedatum, '%d.%m.%Y') AS 'Abreisedatum',
                date_format(Anreisedatum, '%d.%m.%Y') AS 'Anreisedatum', 
                r.Fruehstueck, r.Parkplatz, r.Haustier, r.FK_Zimmer_ID, r.status, r.Sonderwuensche, 
               (DATEDIFF(Abreisedatum, Anreisedatum)*z.PreisProNacht) AS 'GesamtpreisOhneZulagen',
               (DATEDIFF(Abreisedatum, Anreisedatum)*r.Fruehstueck) AS 'ZuschlagFruechstueck',
               (DATEDIFF(Abreisedatum, Anreisedatum)*r.Haustier) AS 'ZuschlagTiere',
               (DATEDIFF(Abreisedatum, Anreisedatum)*r.Parkplatz) AS 'ZuschlagParkplatz',
                ((DATEDIFF(Abreisedatum, Anreisedatum)*z.PreisProNacht)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Fruehstueck)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Parkplatz)+(DATEDIFF(Abreisedatum, Anreisedatum)*r.Haustier)) AS 'GesamtpreisMitZulagen'        
        FROM reservierung r JOIN zimmer z
            ON r.FK_Zimmer_ID = z.Zimmer_ID
        WHERE FK_KundInnen_ID = " . $_SESSION['ID'] . " 
        ";
$result = $db->query($sql);

//Alle Einträge ausgeben
while ($in_row = $result->fetch_array()) {

    $row = array_map('htmlentities', $in_row);

    echo'
        <hr>
        <p style="font-weight: bold;"> Reservierung vom ' . $row['Anreisedatum'] . ' bis ' . $row['Abreisedatum'] . '</p>
        Raum: ';
        if($row['FK_Zimmer_ID'] == 1){
            echo'Sonnenscheinraum';
        }
        if($row['FK_Zimmer_ID'] == 2){
            echo'Mondscheinzimmer';
        }
    echo'
        <br> 
        Gesamtpreis ohne Zuschlägen: ' . $row['GesamtpreisOhneZulagen'] . ' €
    ';
    echo'
        <br>
        <div style="font-size: 19px">
    ';
        if($row['Fruehstueck'] == 0){
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
            echo'Gesamtzuschlag Haustiere: '.$row['ZuschlagTiere'].'€ ';
        }
    echo'
        <br>
    ';
        if($row['Parkplatz'] == 0){
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
        </div>
        Gesamtpreis mit Zuschlägen: ' . $row['GesamtpreisMitZulagen'] . ' €
    ';
    echo'
        <br>
        <p style="font-size: 18px"> Status: ' . $row['status'] . '<p>
    ';

    echo'

        <br>
        <br>

    ';
}

?>
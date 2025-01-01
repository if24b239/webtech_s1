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
        if(isset($_POST["status_filter"])){
            $db_filter = "WHERE status = '".$_POST["status_filter"]."'";
            if($_POST["status_filter"]=='clear'){
                $db_filter='';
            }
        }
        else{
            
            $db_filter='';
            $_POST["status_filter"]='clear';
        }

            
        db_conn_check();
        $i = 0;
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
                $db_filter
                ORDER BY Anreisedatum asc;
                ";
        $result = $db->query($sql);

        while ($row = $result->fetch_array()) {
            
            $i++;
            if($i==1){
                $bg_color = 'var(--background-color)';
            }
            if($i==2){
                $bg_color = 'var(--darker-background-color)';
                $i=0;
            }
            echo'

                <details style="border-style: groove; border-color: var(--text-color);">
                    <summary style="background-color:'.$bg_color.'; list-style: none;">
                        <table summary=""style="border-style:none; display:inline-table;">
                            <tr>
                                <td>
                                    Reservierung: ' . $row['Reservierungs_ID'] . '
                                </td>
                                <td>
                                    vom ' . $row['Anreisedatum'] . ' bis ' . $row['Abreisedatum'] . '
                                <td>
                                <td>
                                    im ';
                                        if($row['FK_Zimmer_ID'] == 1){
                                            echo'Sonnenraum';
                                        }
                                        if($row['FK_Zimmer_ID'] == 2){
                                            echo'Mondscheinzimmer';
                                        } echo'
                                </td>  
                                <td sytle=""width>
                                    Gesammtpreis    ' . $row['GesammtpreisMitZulagen'] . ' €
                                </td>
                                <td>
                                    ↓
                                </td>
                            </tr>
                        </table>
                               
                    </summary>  
                    <div style="border-style: dotted; border-color: var(--darker-background-color);">
                        <p>gebucht von    ' . $row['vorname'] . ' ' . $row['nachname'] . '</p>
                    </div>
                    <div style="border-style: dotted; border-color: var(--darker-background-color);">
                        <p>Preis ohne Zuschläge    ' . $row['GesammtpreisOhneZulagen'] . ' €</p>
                    </div>
                    <table>
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
                    <div style="border-style: dotted; border-color: var(--darker-background-color);">
                        Status der Reservierung:

                        <form class="" action="admin_reservation_change_action.php" method="POST" style="display:inline">

                            <input type="hidden" name="Reservierungs_ID" value="' . $row['Reservierungs_ID'] . '">
                            <select name="new_status" id="new_status">';
                            
                                if ($row['status']=="neu") {
                                    echo '<option value="neu" selected="selected">neu</option>';
                                }
                                else {
                                    echo '<option value="neu">neu</option>';
                                }
                                if ($row['status']=="bestaetigt") {
                                    echo '<option value="bestaetigt" selected="selected">bestätigt</option>';
                                }
                                else {
                                    echo '<option value="bestaetigt">bestätigt</option>';
                                }
                                if ($row['status']=="storniert") {
                                    echo '<option value="storniert" selected="selected">storniert</option>';
                                }
                                else {
                                    echo '<option value="storniert">storniert</option>';
                                }
                                
                                echo '
                            </select>
                            <button typ="submit">Status ändern</button>
                        </form>
                    </div>
                </details>
            
            ';
        }

    ?>
        <form class="" action="admin_reservation_administration.php" method="POST">
            <select name="status_filter" id="status_filter">
                
                <option <?php if($_POST["status_filter"]== "clear"){echo'selected="selected"';}?>value="clear">Alle anzeigen</option>
                <option <?php if($_POST["status_filter"]== "neu"){echo'selected="selected"';}?>value="neu">Status - neu</option>
                <option <?php if($_POST["status_filter"]== "bestaetigt"){echo'selected="selected"';}?>value="bestaetigt">Status - bestätigt</option>
                <option <?php if($_POST["status_filter"]== "storniert"){echo'selected="selected"';}?>value="storniert">Status - storniert</option>
            </select>
            <button typ="submit">sortiere</button>
        </form>
    </section>
    <!--Status ändern über Reservierungs ID-->


    <!--User*Innenstatus in der DB anlegen und verändern können -->
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
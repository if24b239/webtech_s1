<?php
    session_start();
    if(isset($_POST["status_filter"])){
        $db_filter = "WHERE status = '".$_POST["status_filter"]."'";
        if($_POST["status_filter"]=='alle'){
            $db_filter='';
        }
    }
    else{
        
        $db_filter='';
        $_POST["status_filter"]='alle';
    }

?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "User*Innenverwaltung"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <!--Alle UserInnen nach Nachname alphabet ausgeben -->
    <section class="flex"> 
        <div>
        <form class="right" action="admin_user_administration.php" method="POST">
            <select name="status_filter" id="status_filter">
                
                <option <?php if($_POST["status_filter"]== "alle"){echo'selected="selected"';}?>value="alle">Alle anzeigen</option>
                <option <?php if($_POST["status_filter"]== "aktiv"){echo'selected="selected"';}?>value="aktiv">Status - Aktiv</option>
                <option <?php if($_POST["status_filter"]== "inaktiv"){echo'selected="selected"';}?>value="inaktiv">Status - Inaktiv</option>
            </select>
            <button typ="submit">sortiere</button>
        </form>

        <!-- Alle user ausgeben -->
        <?php
            db_conn_check();
            $i = 0; //Variable um jede Zweite UserIn in einer anderen Farbe anzuzeigen.
            // Datenbank abfrage
            $sql = "SELECT * FROM person WHERE Admin_ID IS NULL ORDER BY nachname";
            $result = $db->query($sql);

            // create a form for the whole list with every element having a submit button for it
            echo '
        <form id="status_change" action="admin_user_change_action.php" method="POST">
        </form>
            ';

            while ($row = $result->fetch_array()) {
                $active_string = '';
                if ($row['active'] == 1) {
                    $active_string = "Aktiv";
                } else {
                    $active_string = "Inaktiv";
                }

                $i++;
                if ($i%2) {
                    $bg_color = 'var(--background-color)';
                } else {
                $bg_color = 'var(--darker-background-color)';
                }
                echo '
        <details style="border-style: groove; border-color: var(--text-color);">
            <summary style="background-color:'.$bg_color.'; list-style: none;">
                <table summary=""style="border-style:none; display:inline-table;">
                    <tr>
                        <td>
                            Gast: ' . $row['nachname'] . ' ' . $row['vorname'] . '
                        </td>
                        <td>
                            Username: '. $row['username'] .'
                        </td>
                        <td>
                            Status: ' . $active_string . '
                        </td>
                        <td>
                            <button type="submit" name="action" form="status_change" value="'.$row["Person_ID"].'">
                                Change Status    
                            </button>    
                        </td>
                        <td>
                            ↓
                        </td>
                    </tr>
                </table>
            </summary>
        </details>
                ';
            }
        ?>

    </section>
    <!--UserInnen über ID verändern -->

    <!--User*Innenstatus in der DB anlegen und verändern können -->
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
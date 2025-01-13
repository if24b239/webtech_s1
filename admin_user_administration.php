<?php
    session_start();
    if(isset($_POST["status_filter"])){
        $string='';

        if ($_POST["status_filter"] == "aktiv") {
            $string='1';
        } else if ($_POST["status_filter"] == "inaktiv") {
            $string='0';
        }
        
        $db_filter = "WHERE Admin_ID IS NULL AND active = ". $string;
        if($_POST["status_filter"]=='alle'){
            $db_filter='WHERE Admin_ID IS NULL';
        }
    }
    else{
        
        $db_filter='WHERE Admin_ID IS NULL';
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
            $sql = "SELECT * FROM person $db_filter ORDER BY nachname";
            $result = $db->query($sql);

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

                // get selection of gender
                $gender_m = '';
                $gender_f = '';
                $gender_o = '';

                if ($row["Gender"] == 'female') {
                    $gender_f = 'selected="selected"';

                } else if ($row["Gender"] == 'male') {
                    $gender_m = 'selected="selected"';

                } else if ($row["Gender"] == 'other') {
                    $gender_o = 'selected="selected"';
                }

                // get selection of status
                $active_y = '';
                $active_n = '';

                if ($row['active']) {
                    $active_y = 'selected="selected"';
                } else {
                    $active_n = 'selected="selected"';
                }

                // echo the list of all users and forms to edit them
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
                            ↓
                        </td>
                    </tr>
                </table>
            </summary>
            <form id="form_'. $row['Person_ID'] .'" method="POST" action="admin_user_change_action.php">
                <label id="first_name" for="first_name">Vorname:</label>
                <input type="text" name="first_name" id="first_name" value="'. $row['vorname'] .'" required><br>

                <label id="second_name" for="second_name">Nachname:</label>
                <input type="text" name="second_name" id="second_name" value="'. $row['nachname'] .'" required><br>

                <label id="email" for="email">Email:</label>
                <input type="text" name="email" id="email" value="'. $row['E_Mail'] .'" required><br>

                <label id="gender" for="gender">Gender:</label>
                <select for="gender" name="gender" id="gender">
                    <option '.$gender_m.' value="male">Bro</option>
                    <option '.$gender_f.' value="female">Sis</option>
                    <option '.$gender_o.' value="other">Crow</option>
                </select><br>

                <label id="user_name" for="user_name">Username:</label>
                <input type="text" name="user_name" id="user_name" value="'. $row['username'] .'" required><br>

                <label id="password" for="password">Password:</label>
                <input type="text" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br>

                <label id="status" for="status">status:</label>
                <select for="status" name="status" id="status">
                    <option '.$active_y.' value="1">Aktiv</option>
                    <option '.$active_n.' value="0">Nicht Aktiv</option>
                </select><br>

                <input type="hidden" name="user_id" value="'. $row['Person_ID'] .'">

                <button type="submit">Speichern</button>
            </form>
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
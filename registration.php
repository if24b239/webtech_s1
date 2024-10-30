<!DOCTYPE html>
<html lang="de">

<?php $title = "Registrierung"; include 'php_inserts\head.php' ?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section>
        <form class="col-12" action="registration_action.php" target="_blank" method="Post">
            <h2>Registrierung</h2>
            <div class="col-4">
                <label id="gender" for="gender">Anrede</label><br>
                <select for="gender" id="gender">
                    <option value="female">Frau</option>
                    <option value="male">Herr</option>
                    <option value="other">Vorname Nachname</option>
                </select>
            </div>
            <div class="col-4">
                <label id="first_name" for="first_name">Vorname:</label><br>
                <input type="text" name="first_name" id="first_name" required>
            </div>
            <div class="col-4">
                <label id="second_name" for="second_name">Nachname:</label><br>
                <input type="text" name="second_name" id="second_name" required>
            </div>
            <div class="col-4">
                <label id="email">E-Mail Adresse:</label><br>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="col-4">
                <label id="user_name_registration" for="user_name_registration">Username:</label><br>
                <input type="text" name="user_name_registration" id="user_name_registration" required>
            </div>
            <div class="col-4">
                <label id="password" for="password">Passwort:</label><br>
                <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            </div>
            <div class="col-4">
                <label id="password_repitition" for="password_repitition">Passwortwiederholung:</label><br>
                <input type="password" name="password_repitition" id="password_repitition" required>
            </div>
            <br>
            <div class="col-12">
                <button type="submit">Bestätigen</button>
            </div>

        </form>
    </section>

    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
<!DOCTYPE html>
<html lang="de">

<?php $title = "Startseite"; include 'php_inserts\head.php' ?>

<body>
    
    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>

    <section>
        <form class="col-12" action="login_action.php" target="_blank" method="Post">
            <h2>Login</h2>
            <div class="col-12">
                <label id="user_name_login" for="user_name_login">Username:</label><br>
                <input type="text" name="user_name_login" id="user_name_login" required>
            </div>
            <div class="col-12">
                <label id="password_login" for="password_login">Passwort:</label><br>
                <input type="password" name="password_login" id="password_login" required>
            </div>
            <br>
            <div class="col-12">
                <button type="submit">Einloggen</button>
            </div>
        </form>
    </section>
   
    <?php include 'php_inserts\footer.php' ?>
    
</body>
</html>
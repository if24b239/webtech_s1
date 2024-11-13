<?php 

/* 
USAGE: no special usage
*/

echo '
<nav>

    <input type="checkbox" id="toggle_button_nav">
    <label for="toggle_button_nav" class="toggle_button_nav">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </label>

    <ul>
        <li><a href="main.php">Startseite</a></li>
';
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1) {
    echo '
        <li><a href="room_reservation.php">Zimmerreservierung</a></li>
        <li><a href="profile.php">Profil</a></li>
    ';
}
echo '
        <li><a href="login.php">Login</a></li>
        <li><a href="registration.php">Registrierung</a></li>
    </ul>

</nav>
';

?>
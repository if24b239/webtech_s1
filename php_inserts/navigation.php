<?php 
    if(!isset($_SESSION["gender"])){
        $_SESSION["gender"]='male';
    }
    if(!isset($_SESSION["first_name"])){
        $_SESSION["first_name"]='Max';
    }
    if(!isset($_SESSION["last_name"])){
        $_SESSION["last_name"]='Mustermann';
    } 

    if(!isset($_SESSION["logged_in"])){
        $_SESSION["logged_in"] = 0;

    }
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
        <h1>';
            if($_SESSION["logged_in"] == 1){
                if($_SESSION["gender"]=='female'){
                    echo'Willkommen Frau '.$_SESSION["last_name"].'!';
                }
                if($_SESSION["gender"]=='male'){
                    echo'Willkommen Herr '.$_SESSION["last_name"].'!';
                }
                if($_SESSION["gender"]=='other'){
                    echo'Willkommen '.$_SESSION["first_name"].' '.$_SESSION["last_name"].'!';
                }
            }
        echo'
        </h1>
        
        
        <li><a href="main.php">Startseite</a></li>
';
if ($_SESSION["logged_in"] == 1) {
    echo '
        <li><a href="profile.php">Profil</a></li>
        <li><a href="room_reservation.php">Zimmerreservierung</a></li>   
        <li><a href="logout_action.php">Logout</a></li>
    ';
}
echo '
        <li><a href="registration.php">Registrierung</a></li> ';
if($_SESSION["logged_in"] == 0){
    echo'
        <li><a href="login.php">Login</a></li>
    ';
}
echo'
    </ul>

</nav>
';

?>
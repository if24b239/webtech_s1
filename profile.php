<?php
    session_start();

    if (!isset($_SESSION["user_name"])) {
        $_SESSION["user_name"] = '';
    }
?>

<!DOCTYPE html>
<html lang="de">

<?php $title = "Profilverwaltung"; include 'php_inserts\head.php' ?>

<body>

    <?php include 'php_inserts\header.php' ?>

    <?php include 'php_inserts\navigation.php' ?>
    
    <section class="flex">
        
        <div>
            <?php
                echo '  Willkommen '.$_SESSION["user_name"].'';
            ?>
            <br>
            <br>
            <br> 
            <a href="room_reservation.php">Zimmerreservierung</a>   
        </div>
        <br>
        <div class="halfScreen">
            <div>
                <p>Reservierungsdetails</p>
                <?php 
                if (isset($_SESSION["reservierungen"])) {
                    foreach ($_SESSION["reservierungen"] as $x) {
                        echo '
                            <p>ZIMMER: '.$x["room"].'</p>
                        ';
                    }
                }
                ?>
            </div>
            
            <div>
                <p>Stammdaten<p>
            </div>
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
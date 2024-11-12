<?php
    session_start();
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
            <a href="roomReservation.php">Zimmerreservierung</a>   
        </div>
        <br>
        <div class="halfScreen">
            <div>
                <p>Reservierungsdetails</p>
            </div>
            
            <div>
                <p>Stammdaten<p>
            </div>
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
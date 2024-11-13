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
            <br>
            <br>
        </div>
        <br>
        <div class="halfScreen">
            <div class="halfScreenChild test1">
                <h1>Reservierungsdetails</h1>
                <?php 
                if (isset($_SESSION["reservierungen"])) {
                    foreach ($_SESSION["reservierungen"] as $x) {
                        echo '
                            <div class="bordered">
                                <p>Reservierung vom '.$x["arrival"].' bis zum '.$x["departure"].':</p>  
                                <br>
                                <p>gewähltes Zimmer: '.$x["room"].'</p>
                                <br>
                                <p>Frühstück: </p>
                        ';
                                    if($x["breakfast"]=='with_breakfast'){
                                        echo 'mit Frühstück';
                                    }
                                    else if ($x["breakfast"]=='without_breakfast'){
                                        echo 'ohne Frühstück';
                                    }
                                echo '
                                    <br>
                                    <p>Parkplatz: </p> 
                                ';
                                if($x["parking"]=='with_parking'){
                                    echo 'mit Parkplatz';
                                }
                                else if ($x["parking"]=='without_parking'){
                                    echo 'ohne Parkplatz
                                        <br>
                                    ';
                                }

                                echo '
                                    <br>
                                    <p>welche Haustiere kommen mit?</p> 
                                    <br>
                                ';
                                if($_SESSION["pet"] &1){
                                    echo '
                                        <p>Pferd</p>
                                    ';
                                }
                                if($_SESSION["pet"] &2){
                                    echo '
                                        <p>Hund</p>
                                    ';
                                }
                                if($_SESSION["pet"] &4){
                                    echo '
                                    <p>Chimäre</p>
                                    ';
                                }

                                echo '
                                    <p>Anmerkungen: '.$x["special_requests"].'</p>
                                    <br>
                                
                            </div>
                                    ';
                        
                    }
                }
                ?>
            </div>
            
            <div class="halfScreenChild right test2">
                <h1>Stammdaten</h1>

            </div>
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
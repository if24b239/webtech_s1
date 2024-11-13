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
                echo '  Willkommen '.$_SESSION["user_name"].'!';
            ?>
            <br>  
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
                                <p>gewähltes Zimmer: <br>'.$x["room"].'</p>
                                <br>
                                <p>Frühstück: </p>
                        ';
                                    if($x["breakfast"]=='with_breakfast'){
                                        echo 'mit Frühstück
                                            <br>
                                        ';
                                    }
                                    else if ($x["breakfast"]=='without_breakfast'){
                                        echo 'ohne Frühstück
                                            <br>
                                        ';
                                    }
                                echo '
                                    <br>
                                    <p>Parkplatz: </p> 
                                ';
                                if($x["parking"]=='with_parking'){
                                    echo 'mit Parkplatz
                                        <br>
                                    ';
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
                                    <p>Anmerkungen: <br>'.$x["special_requests"].'</p>
                                    <br>
                                
                            </div>
                                    ';
                        
                    }
                }
                ?>
            </div>
            
            <div class="halfScreenChild right test2">
                <h1>Profildaten</h1>
                    <div class="bordered">
                    <?php
                        if($_SESSION["gender"]=='female'){
                            echo'Anrede: Frau '.$_SESSION["last_name"].'';
                        }
                        if($_SESSION["gender"]=='male'){
                            echo'Anrede: Herr '.$_SESSION["last_name"].'';
                        }
                        if($_SESSION["gender"]=='other'){
                            echo'Anrede: '.$_SESSION["first_name"].' '.$_SESSION["last_name"].'';
                        }
                        echo'
                            <br>
                            <br>
                            E-Mail Adresse: '.$_SESSION["email"].'
                        ';

                        echo'
                            <br>
                            <br>
                            Username: '.$_SESSION["user_name"].'
                        ';
                        echo '';
                        ?>

                    </div>
                <form action="profile_change_action.php" method="Post">
                    
                </form> 
            </div>
        </div>
        
    </section>
    
    <?php include 'php_inserts\footer.php' ?>

</body>
</html>
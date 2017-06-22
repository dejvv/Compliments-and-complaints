<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Spletna Trgovina">
        <meta name="keywords" content="Spletna, Trgovina">
        <title>Hvala</title>
    </head>
    <body>
        <?php
        session_start();
            if (!empty($_POST['ime']) && !empty($_POST['besedilo'])) // ce pridobljena vnosa nista prazna
            {
                // saniteta za sql injection
                $izbrano = null; // zaposleni/prostor/drugo
                
                if(!empty($_POST['zaposleni'])){ // če vnos ni prazen
                    $izbrano = htmlspecialchars(pg_escape_string($_POST['zaposleni'])); // si ga shranim
                }
                if(!empty($_POST['prostori'])){
                    $izbrano = htmlspecialchars(pg_escape_string($_POST['prostori']));
                }
                if(empty($_POST['zaposleni']) && empty($_POST['prostori'])){ // če sta oba prazna
                    $izbrano = 'Drugo'; // je uporabnik izbral nekaj drugega
                }
                
                
                $ime =  htmlspecialchars(pg_escape_string($_POST['ime']));
                $besedilo =  htmlspecialchars(pg_escape_string($_POST['besedilo']));
                $pohv_pri = htmlspecialchars(pg_escape_string($_POST['submit'])); // submit button (value ? Pohvala:Pritozba)
                
                include_once '../control/pohv_pri.php';
                $abc = new pp();

                // ce je vse ok ($besedilo, $pohv_pri, $ime, $izbrano)
                
                if($abc ->vstaviPohvaloPritozbo($pohv_pri, $izbrano, $ime, $besedilo))
                {
                    $_SESSION['done'] = 'done';
                    header('Location: thankyou.php'); // preusmerim na zahvalno stran
                    exit();
                    
                }else{ // napaka
                    header('Location: index.php'); // preusmerim nazaj
                    echo "Prosim ponovi!\n";
                }
                
                
            }else{ // ce je kateri(ali oba) vnos prazen
                header('Location: index.php?=izpolniPolja'); // preusmerim nazaj
                echo "Izpolni vsa polja!\n";
            }
        ?>
    </body>
</html>

<?php
$zaposleni = $_POST['zaposleni'];
$_SESSION['zaposleni'] = $zaposleni;
?>
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
        echo "<div class='info'> ";
        echo "<table class='sc_tbl'> ";

        echo "<tr ><td ><h6 class='sc'>Sessions: ";
        print_r($_SESSION);
        echo "Your session ID is " . session_id() . " ";
        echo "</h6></td></tr>";

        echo "<tr ><td ><h6 class='sc'>GET:";
        print_r($_GET);
        echo "Your session GET variables are";
        echo "</h6></td></tr>";

        echo "<tr ><td ><h6 class='sc'>POST: ";
        echo "Your session POST variables are\
\r";
        print_r($_POST);
        echo "</h6></td></tr>";
// here goesthe break
        echo "</table> ";
        echo "</div> ";
        
        if(!isset($_POST['prostori'])){
            $vbazo4 = $_POST['zaposleni'];
            $vzrok = $_POST['ime'];
            $bes = $_POST['besedilo'];
            $sub = $_POST['submit'];
        }else if(!isset($_POST['zaposleni'])){
            $vbazo4 = $_POST['prostori'];
            $vzrok = $_POST['ime'];
            $bes = $_POST['besedilo'];
            $sub = $_POST['submit'];
        }else {
            $vbazo4 = "drugo";
            $vzrok = $_POST['ime'];
            $bes = $_POST['besedilo'];
            $sub = $_POST['submit'];
        }
        echo 'Zaposleni ali prostor: ' . $vbazo4;
        echo 'Vzrok oz. namen: ' . $vzrok;
        echo 'Besedilo: ' . $bes;
        echo 'Pohvala ali pritozba: ' . $sub;
        ?>
    </body>
</html>

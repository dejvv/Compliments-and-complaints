<?php
session_start();
if(!isset($_SESSION['done'])){
    header('Location: index.php?=ponovno');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function a(){
                <?php
                    unset($_SESSION['done']); // unset sejo uporabnika
                    /* ne rabim preverjat ce je ze seja, ker ce je nebi blo nebi bilo dostopa*/
           
                    if(isset($_COOKIE[session_name()])) // ce je piskotek, ga unici
                        setcookie(session_name(), '', time() - 10000);
           
                    session_destroy(); // uniči sejo;
                 ?>
                window.location.assign("index.php");
            }
        </script>
    </head>
    <body>
        <p>Hvala za oddano mnenje!</p>
        <br>
        <button onclick="a()">Nazaj na pohvale & pritožbe</button>
    </body>
</html>

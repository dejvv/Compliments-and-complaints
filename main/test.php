<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../control/pohv_pri.php';

$abc = new pp(); // objekt

//$abc ->vstaviPohvaloPritozbo('ulala', 'Pohvala', 'no ja');
//echo "Text: " . $abc ->getText(). "<br>";
//echo "Pohvala ali pritozba: " . $abc ->getPohv_pri(). "<br>";
//echo "Vzrok/namen: " . $abc ->getVzrok(). "<br>";

$res = $abc ->vrniVseZaposlene();
?>
<?php
if(pg_num_rows($res) > 0){
    
?>
<table border="1">
    <thead>
        <tr>
            <th>ime & priimek</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row = pg_fetch_assoc($res)){
        ?>
        <tr>
            <td><?php echo $row['ime_prii'];?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
}


$res = $abc ->vrniVseProstore();

if(pg_num_rows($res) > 0){
    
?>
<table border="1">
    <thead>
        <tr>
            <th>naziv</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($row = pg_fetch_assoc($res)){
        ?>
        <tr>
            <td><?php echo $row['naziv'];?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<?php
}
?>
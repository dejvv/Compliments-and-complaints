<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Connection na bazo

class Baza{
    
    private $dbconn; // povezava na bazo
    
    public function __construct($a) {
        echo $a;
        $this->dbconn = pg_connect("host=www2.scptuj.si port=5432 dbname=pohv_pri user=pohv_pri password=pohvala123");
        // psql -d pohv_pri -U pohv_pri -h www2.scptuj.si
    }
    
    public function testConn() {
        
        echo 'testConn';
        
        $sql = "select * from pohvale_pritozbe;";
        $result = pg_query($this->dbconn, $sql); // query
        
        if (!$result) {
            echo "Napaka v povprasevanju.\n";
            exit;
        }
        
        if (pg_num_rows($result) == 1) {
            pg_free_result($result);
            return true;
        }
        
        pg_free_result($result);
        return false;
    }
    
    public function __destruct() {
        pg_close($this->dbconn);
    }
}

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class pp{
    private $id; // id v bazi  (test) SERIAL
    private $text;  // besedilo (test)
    private $pohv_pri; // pohvala ali pritozba
    private $vzrok; // namen oz. vzrok pohvale ali pritozbe
    private $izbrano; // zaposleni/prostor/drugo
    
    private $dbconn; // povezava na bazo
    
    public function __construct() { // KONSTRUKTOR
        $this->dbconn = pg_connect("host=www2.scptuj.si port=5432 dbname=pohv_pri user=pohv_pri password=pohvala123");  
        // psql -d pohv_pri -U pohv_pri -h www2.scptuj.si
    }
    
    public function vstaviPohvaloPritozbo($vrsta, $izbrano, $vzrok, $besedilo){ // vstavljam pohavlo/pritozbo
        
        $sql = "INSERT INTO pohvale_pritozbe(vrsta, izbrano, vzrok, besedilo) VALUES('$vrsta', '$izbrano', '$vzrok', '$besedilo');";
        
        $result = pg_query($this->dbconn, $sql); // query

        if (!$result) {
            echo "Vaše mnenje ni bilo uspešno oddano.\n";
            pg_free_result($result);
            exit;
        }
        
        return true;
    }
    
    public function vrniVseZaposlene(){ // vrnem vse zaposlene 
        $sql = "select * from zaposleni;";
        $result = pg_query($this->dbconn,$sql);
        if(!$result) {
            echo "Napaka v povpraševanju.\n";
            exit;
        }
        return $result;
    }
    
     public function vrniVseProstore(){ // vrnem vse prostore 
        $sql = "select * from prostori;";
        $result = pg_query($this->dbconn,$sql);
        if(!$result) {
            echo "Napaka v povpraševanju.\n";
            exit;
        }
        return $result;
    }
    
    function getId() {
        return $this->id;
    }

    function getText() {
        return $this->text;
    }

    function getDbconn() {
        return $this->dbconn;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setDbconn($dbconn) {
        $this->dbconn = $dbconn;
    }
    
    function getPohv_pri() {
        return $this->pohv_pri;
    }
    
    function setPohv_pri($pohv_pri) {
        $this->pohv_pri = $pohv_pri;
    }

    function getVzrok() {
        return $this->vzrok;
    }

    function setVzrok($vzrok) {
        $this->vzrok = $vzrok;
    }
    
    function getIzbrano() {
        return $this->izbrano;
    }

    function setIzbrano($izbrano) {
        $this->izbrano = $izbrano;
    }
    
    public function __destruct() { // DESTRUKTOR
        pg_close($this->dbconn);
    }


}
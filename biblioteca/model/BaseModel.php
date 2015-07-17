<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseModel
 *
 * @author PC
 */
class BaseModel {
    //put your code here
    //public $css = "";
    
    private $hostname;
    private $username;
    private $passoword;
    private $database;
    
    function __construct($pag) {
        $this->pagina = $pag;
        
    }
    
    public function initConfig($param){
        if(isset($param))
            include $param;
        else
            include ("inc/configB.php");
    }
    
    
    public function connect() {
        $connect = mysql_connect($this->hostname, $this->username, $this->password) or die(mysql_error());
        return mysql_select_db($this->database, $connect) or die(mysql_error());
        
    }

    public function desconnect() {
        $close = mysql_close($connect) or die(mysql_error);
    }
    
    public function loadDefaultArray(){
        $query = ("SELECT * FROM tb_configuracoes");
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    public function loadDefaultObject(){
        $query = ("SELECT * FROM tb_configuracoes");
        $result = mysql_query($query);
        return mysql_fetch_object($result);
    }
    
    public function loadQueryArray($query){
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    public function loadQueryObject($query){
        $result = mysql_query($query);
        return mysql_fetch_object($result);
    }
    public function loadQuery($query){
        return mysql_query($query);
    }
    
    
    
}

?>

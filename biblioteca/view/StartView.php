<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StartView
 *
 * @author PC
 */
class StartView extends PageView{
    //put your code here
    
    function atualisaLista($param){
        echo "<p id=\"a\" class=\"exclude\">algum texto aqui ";
        echo "<br> argumento 4: " . $param[2] . "</p>";        
    }
    function mostraLista($lista){
        echo $lista;
    }
    
}

?>

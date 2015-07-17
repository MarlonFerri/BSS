<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of listas_user
 * 
 * Classe de modelo de dados para listas
 * com estrutura de listas encadeadas com parâmetros primários as listas
 * secundários são as atividades e assim por diante.
 * @author MarlonJean
 */
class ListasUser {
    //put your code here
    public $listas = array();
    
    
    function __construct($result) {
        while($all_datas = mysql_fetch_object($result)){
            
        }
    }
    function get_listas(){
        
    }
}

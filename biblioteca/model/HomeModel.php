<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeModel
 *
 * @author MarlonJean
 */
class HomeModel extends BaseModel {
    public function loadSaudacao(){
        
    }
    
    public function loadMosaicoItem($ref){
        $query = "SELECT * from pag_conteudos WHERE c_ref = '$ref' and c_pag = 'home'";
        return $this->loadQueryObject($query);
    }
    
    public function loadMosaicoBox($id){
        $query = "SELECT * from pag_conteudos WHERE id = '$id'";
        return $this->loadQueryObject($query);
    }
}

?>

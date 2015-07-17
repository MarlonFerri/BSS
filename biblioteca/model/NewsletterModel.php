<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsletterModel
 *
 * @author PC
 */
class NewsletterModel extends BaseModel{
    //put your code here
    public function checkEmail($email){
        $query = "select * from tb_news where email = '$email'";
        $result = $this->loadQuery($query);
        if(mysql_num_rows($result)>0)
            return true;
        else
            return false;
    }
    public function registraEmail($email){
        $query = "INSERT INTO tb_news (email) VALUES ('$email')";
        return $this->loadQuery($query);
        
    }
}

?>

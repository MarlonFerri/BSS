<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminModel
 *
 * @author Marlon
 */
class AdminModel extends BaseModel {

//put your code here
    public function __construct() {
        
    }

    function localizaAdmin($id_admin, $pass_admim) {
        $query = "select * from users_login where id = '$id_admin'";
        $result = $this->loadQuery($query);
        if (mysql_num_rows($result) == 1) {

            $resultado = $this->loadQueryObject($query);
            if (md5($resultado->user_senha) == $pass_admim)
                return true;
            else
                return false;
        }
        else
            return false;
    }

    function getConteudos($pag) {
        $query = "select * from pag_conteudos where c_pag = '$pag'";
        $resultado = $this->loadQuery($query);

        if (mysql_num_rows($resultado) == 0)
            return false;
        else
            return $this->loadQuery($query);
    }

    function getConteudo($id) {
        $query = "select * from pag_conteudos where id = '$id'";
        $resultado = $this->loadQuery($query);

        if (mysql_num_rows($resultado) != 1)
            return false;
        else
            return $this->loadQueryObject($query);
    }

    function addConteudo($nome, $ref, $pag, $link, $modelo, $cont1, $cont2, $cont3, $imgref, $img1, $img2, $img3) {
        $query = "INSERT INTO pag_conteudos
            (c_nome, c_ref, c_pag, c_link, c_modelo, c_conteudo1, c_conteudo2, c_conteudo3, c_img_ref, c_img1,c_img2,c_img3)
             values ('$nome','$ref','$pag','$link','$modelo','$cont1','$cont2','$cont3','$imgref','$img1','$img2','$img3')";
        $result = $this->loadQuery($query);
        return $result;
    }

    function editConteudo($id, $nome, $ref, $pag, $link, $modelo, $cont1, $cont2, $cont3, $imgref, $img1, $img2, $img3) {
        if ($imgref != "") {
            $query = "UPDATE pag_conteudos SET c_img_ref='$imgref' where id = '$id'";
            $this->loadQuery($query);
        }
        if ($img1 != "") {
            $query = "UPDATE pag_conteudos SET c_img1='$img1' where id = '$id'";
            $this->loadQuery($query);
        }
        if ($img2 != "") {
            $query = "UPDATE pag_conteudos SET c_img2='$img2' where id = '$id'";
            $this->loadQuery($query);
        }
        if ($img3 != "") {
            $query = "UPDATE pag_conteudos SET c_img3='$img3' where id = '$id'";
            $this->loadQuery($query);
        }
        $query = "UPDATE pag_conteudos 
                SET
                c_nome='$nome',
                c_pag='$pag',
                c_ref='$ref',
                c_link='$link',
                c_modelo='$modelo',
                c_conteudo1='$cont1',
                c_conteudo2='$cont2',
                c_conteudo3='$cont3'
                where id='$id'";
        echo "\n$query";
        $this->loadQuery($query);
        return "ok, vai lah";
    }

    function excluiConteudo($id) {
        if ($this->getConteudo($id))
            $query = "delete from pag_conteudos where id = '$id'";
        else
            return false;

        if ($this->loadQuery($query))
            return true;
        else
            return false;
    }

}

?>

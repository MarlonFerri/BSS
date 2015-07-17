<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registroModel
 *
 * @author PC
 */
class RegistroModel extends BaseModel {

    //put your code here
    private $codigo_confirmacao;
    /*
     * @nome nome provindo do registro de usu�rio
     */
    public function checkNome($nome) {
        
    }

//    public function checkLogin($email) {
//        $query = "select * from users_login where user_email = '$email'";
//        $result = $this->loadQuery($query);
//        if (mysql_num_rows($result) > 0)
//            return true;
//        else
//            return false;
//    }

    public function checkSenha1($senha1) {
        
    }

    public function checkSenha2($senha2) {
        
    }
    function checkEmail($email) {
        $query = "select * from users_login where user_email = '$email'";
        $result = $this->loadQuery($query);
        //echo "<br>linhas:".mysql_num_rows($result)."<br>";
        if (mysql_num_rows($result) > 0)
            return true;
        else
            return false;
    }

    public function registrarUser($login, $senha, $nome, $codigo) {
        $tipo = $this->getInicialUser();
        $query = "INSERT INTO users_login (user_email, user_senha, user_tipo) VALUES ('$login', '$senha', '$tipo');";
        //echo "<br>" . $query . "<br>";
        //echo $this->loadQuery($query);
        if (!$this->loadQuery($query))
            echo "Erro ao gravar login" ;
        else {
            $id_user = $this->getIdUser($login);
//            $codigo = md5($login . date() . time());
            $query = "insert into users_dados (
                id_user,
                user_nome,
                user_codigo_confirmacao,
                user_confirmacao) 
                values (
                '$id_user',
                '$nome',
                '$codigo',
                'false'
                )";
            //echo "<br>" . $query . "<br>";
            if (!$this->loadQuery($query)){
                echo "Erro ao gravar dados";
                $query = "delete from users_login where id = '$id_user'";
            }
        }
    }

    private function getInicialUser() {
        $query = "select * from bss_config where parametro = 'tipo_usuario_inicial'";
        $resultado = $this->loadQueryObject($query);
        
        return $resultado->valor;
    }

    private function getIdUser($login) {
        $query = "select * from users_login where user_email = '$login'";
        $resultado = $this->loadQueryObject($query);
        
        return $resultado->id;
    }
    
    function getUserConfirmacao($login){
        $id = $this->getIdUser($login);
        $query = "select * from users_dados where id_user = '$id'";
        $resultado = $this->loadQueryObject($query);
        $this->codigo_confirmacao = $resultado->user_codigo_confirmacao;
        return $this->codigo_confirmacao;
    }

}

?>

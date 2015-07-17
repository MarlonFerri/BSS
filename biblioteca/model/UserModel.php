<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserModel
 *
 * @author PC
 */
class UserModel extends BaseModel {

    private $id_user = false;
    private $tar_atras = 0;
    private $tar_dia = 0;
    private $tar_tot = 0;

    function checkLogin($login, $senha) {
        $query = "select * from users_login where user_email = '$login' and user_senha = '$senha'";
        $result = $this->loadQuery($query);
        if (mysql_num_rows($result) == 1) {

            $resultado = $this->loadQueryObject($query);
            $this->id_user = $resultado->id;
            return true;
        }
        else
            return false;
    }

    function checkLoginId($id, $senha) {
        $query = "select * from users_login where id = $id";
        $result = $this->loadQueryObject($query);
        if (md5($result->user_senha) == $senha)
            return true;
        else
            return false;
    }

    function checkTipo() {
        $query = "select * from users_login where id = $this->id_user";
        $result = $this->loadQueryObject($query);
        return $result->user_tipo;
    }

    function loadUser($id_user) {
        
        if (isset($id_user))
            $this->id_user = $id_user;

        if ($this->id_user) {
            $query = "select * from users_login where id = '$this->id_user'";
            $user = $this->loadQueryObject($query);
            //$_SESSION['user_bss'] = $user->login;
            //$_SESSION['user_id_bss'] = $user->id;

            $query = "select * from users_dados where id_user = '$this->id_user'";

            //add checagem de tarefas
            return $this->loadQueryObject($query);
        } else {
            return false;
        }
    }

    function confirmaUser($confirmacao) {
        $query = "select * from users_dados where user_codigo_confirmacao = '$confirmacao'";
        $resultado = $this->loadQuery($query);
        if (mysql_num_rows($resultado)) {
            $data = date("Y/m/d H:i:s");
            $ip = getenv("REMOTE_ADDR");
            $query2 = "update users_dados set user_confirmacao = '1', user_confirmacao_data = '$data', user_confirmacao_ip = '$ip' where user_codigo_confirmacao = '$confirmacao'";
            $this->loadQuery($query2);
            return $this->loadQueryObject($query);
        } else {
            return false;
        }
    }

    function getIdUser() {
        return $this->id_user;
    }

    function listasFromUser() {
        $query = "select * from users_listas where id_user = '$this->id_user'";
        $resultado = $this->loadQuery($query);
        if (mysql_num_fields($resultado) == 0)
            return false;
        else
            return $this->loadQueryArray($query);
    }

    function listaFromUser() {
        $query = "select * from users_listas where id_user = '$this->id_user' and tipo = 'lista'";
        $resultado = $this->loadQuery($query);
        //echo mysql_num_rows($resultado);
        if (mysql_num_rows($resultado) == 0)
            return false;
        else
            return $this->loadQuery($query);
    }

    function listaTarefa($id_lista) {
        $query = "select *from users_lista where id_lista= '$id_lista'";
    }

    function tarefaFromLista($target) {
        $query = "select * from users_listas where sub_from = '$target'";
        $resultado = $this->loadQuery($query);
        //echo mysql_num_rows($resultado);
        if (mysql_num_rows($resultado) == 0)
            return false;
        else
            return $this->loadQuery($query);
    }

    function atualizaLista($id_lista, $id_user, $sub_from, $value, $tipo) {
//        echo $tipo;
        if ($id_lista == "novo") {
            $data = date("y-m-d H:i:s");
            $query = "insert into users_listas 
                (id_user, tipo, conteudo, sub_from, data_criacao)
                values
                ('$id_user',
                 '$tipo',
                 '$value',
                 '$sub_from',
                 '$data')
                ";
        } else {
            $query = "UPDATE users_listas SET conteudo = '$value', sub_from = '$sub_from' where id_lista = '$id_lista' ";
//            echo "<br>$query<br>";
        }
        if ($this->loadQuery($query) or die("erro no banco")) {
//            echo "gravou";
            if ($id_lista == "novo") {
                $query = "select * from users_listas where data_criacao = '$data'";
                $a = $this->loadQueryObject($query);
                $id_lista = $a->id_lista;
            }
        }
        return $id_lista;
    }

    function deletaSubTarefa($id_ex) {
        $query = "select * from users_listas where sub_from = '$id_ex'";
        while ($tarefa = $this->loadQueryObject($query)) {
            $this->deletaSubTarefa($tarefa->id_lista);

            $tarefa->id_lista;
        }
        $query2 = "delete from users_listas where sub_from = '$id_ex'";
        $this->loadQuery($query2);
        $query2 = "delete from users_listas where id_lista = '$id_ex'";
        $this->loadQuery($query2);
    }

    function getDataFinal($id_lista) {
        $query = "select * from users_listas where id_lista = '$id_lista'";
        $resultado = $this->loadQueryObject($query);
        return $resultado->data_final;
    }

    function setDataFinal($id_lista, $date) {
        $query = "update users_listas set data_final = '$date' where id_lista = '$id_lista'";
        $this->loadQuery($query);
    }

    function listaTarefasAtrasadas($id_user) {
        $date = date("Y-m-d");
        $query = "select * from users_listas where data_final < '$date' and id_user = '$id_user'";
        //$this->tar_atras = mysql_num_rows($this->loadQuery($query));
        return $this->loadQuery($query);
    }

    function listaTarefasDia($id_user) {
        $date = date("Y-m-d");
        $query = "select * from users_listas where data_final = '$date' and id_user = '$id_user'";
        //$this->tar_dia = mysql_num_rows($this->loadQuery($query));
        return $this->loadQuery($query);
    }

    function listaTarefasProxima($id_user) {
        $date = date("Y-m-d");
        $query = "select * from users_listas where data_final > '$date' and id_user = '$id_user'";
        //$this->tar_tot = mysql_num_rows($this->loadQuery($query)) + $this->tar_atras + $this->tar_dia;
        return $this->loadQuery($query);
    }

    function registraAcao($id, $tipo, $ip) {
        $date = date("y-m-d H:i:s");
        $query = "insert into ac_users (id_user, tipo_acao, data_acao, ip_user) values('$id','$tipo','$date','$ip')";
        $result = $this->loadQuery($query);
        return $result;
    }

    function subFromLista($sub_from) {
        $query = "select * from users_listas where id_lista = '$sub_from'";
        $result = $this->loadQueryObject($query);
        if ($result->tipo == "lista")
            return $result;
        else
            $result = $this->subFromLista($result->sub_from);
        return $result;
    }

    /*
     * função para conclusão de tarefa e/ou lista
     * retorna o id da lista mãe da tarefa para atualização
     */

    function concluiTarefa($id_lista, $id_user) {
        $data = date("Y/m/d H:i:s");
        $query = "update users_listas set data_conclusao = '$data' where id_lista = '$id_lista' and id_user = '$id_user'";
        $this->loadQuery($query);
        if ($this->concluiSubTarefa($id_lista, $data))
            return true;
        else
            return false;
    }

    function concluiSubTarefa($id, $data) {
        $query = "select * from users_listas where sub_from = '$id'";
        $result = mysql_query($query);
            while ($row = mysql_fetch_object($result)) {
                if ($row->data_conclusao == "0000-00-00 00:00:00") {
                    $query2 = "update users_listas set data_conclusao = '$data' where id_lista = '$row->id_lista'";
                    $this->loadQuery($query2);
                    $this->concluiSubTarefa($row->id_lista, $data);
                }
            }
            return true;
        
    }

    function listaUnica($id_lista) {
        $query = "select * from users_listas where id_lista = '$id_lista'";
        $resultado = $this->loadQuery($query);
        //echo mysql_num_rows($resultado);
        if (mysql_num_rows($resultado) == 0)
            return false;
        else
            return $this->loadQuery($query);
    }

}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author PC
 */
class UserController {

    //put your code here
    private $tarefa_lvl = 0;
    private $document_tarefa = "";
    private $pageModel;

    function __construct($pag) {
        $this->pagina = $pag;
        $this->pageModel = new UserModel($this->pagina);
    }

    function findUser($id) {
        $this->id_pagina = $id;
        $this->preferenciassUser();
        return $this->pageModel->loadUser($this->id_pagina);
    }

    private function preferenciassUser() {
        //carrega defini??es b?sicas do usu?rio
    }

    /*
     * Lista as listas do usuário, devolvendo um object de listas
     * 
     */
    function listasUser($id_lista) {
        $tot_lista = "";
        
        if (isset($id_lista)) {
            $result = $this->pageModel->listaUnica($id_lista);
            $hr = 1;
        } else {
            $result = $this->pageModel->listaFromUser();
            $hr = 0;
        }
        if (mysql_num_rows($result) == 0) {
            echo "<div class=\"lista\">Por onde come&ccedil;ar</div>";
        } else {
            
            // novo aki            
            $lister = new ListasUser($result);
            $listas = array();
            $listas = $lister->get_listas();
//            while ($lista_user = mysql_fetch_object($result)) {
//                if ($lista_user->data_conclusao != "0000-00-00 00:00:00")
//                    $verde = " verde";
//                else
//                    $verde = "";
//
//
//                $tot_lista .= "<div class=\"box_input\">";
//                $tot_lista .= "<a href=\"#\" class=\"minimizar\" ttemp=\"0\"> - </a>";
//                $tot_lista .= "<input type=\"text\" class=\"listas lista" . $verde . "\" id=\"" . $lista_user->id_lista . "_\" value=\"" . $lista_user->conteudo . "\">";
//                if ($verde == "")
//                    $tot_lista .="<a href=\"#\" class=\"concluir\"><img src=\"../../imgs/icons/tick.png\"></a> ";
//                $tot_lista .= "<a href=\"#\" class=\"del\">X</a> ";
//                if ($verde == "")
//                    $tot_lista .= "<a href=\"#\" class=\"add_tarefa\">+</a>";
////                $tot_lista .= $this->inserirSelect($lista_user->id_lista) . "<br>";
//
//                $this->busca($lista_user->id_lista, 0);
//                $tot_lista .= $this->document_tarefa;
//                $this->document_tarefa = "";
//                if (!$hr)
//                    $tot_lista .= "</div><hr>";
//                else
//                    $tot_lista .= "</div>";
//            }
            
            
        }
        return $tot_lista;
    }

    private function busca($target, $lvl) {
        $result = $this->pageModel->tarefaFromLista($target);
        if ($result != false) {
            //echo "<br>? array de tarefa";
            $lvl++;
            $espaco = "";
//            for ($a = 0; $a < $lvl; $a++)
//                $espaco .= "&ShortRightArrow;";
//            $espaco .="&nbsp;";
            while ($tarefa = mysql_fetch_object($result)) {
                if ($tarefa->data_conclusao != "0000-00-00 00:00:00")
                    $verde = " verde";
                else
                    $verde = "";
                $this->document_tarefa .= $espaco . "<div class=\"box_input\">";
                $this->document_tarefa .= "<input type=\"text\" class=\"listas" . $verde . "\" id=\"" . $tarefa->id_lista . "_" . $target . "\" value=\"" . $tarefa->conteudo . "\">";

                if ($verde == "") {
                    $this->document_tarefa .= "<a href=\"#\" class=\"concluir\"><img src=\"../../imgs/icons/tick.png\"></a> ";
                    $this->document_tarefa .= "<a href=\"#\" class=\"del\">X</a> ";
                    $this->document_tarefa .= "<a href=\"#\" class=\"add_tarefa\">+</a>";
                    $this->document_tarefa .= "<br>Data final: " . $this->inserirSelect($tarefa->id_lista) . "<br><br>";
                } else {
                    $this->document_tarefa .= "<a href=\"#\" class=\"del\">X</a> ";
                    $this->document_tarefa .= "<p>Tarefa conclu&iacute;da</p>";
                }

                $this->busca($tarefa->id_lista, $lvl);
                $this->document_tarefa.= "</div>"; //<br>";
            }
        }
    }

    function requestLista($id_lista, $id_user, $value, $sub_from, $acao) {
        //echo "<script>alert(\"dentro request = $id_lista\");</script>";
        switch ($acao) {
            case "blur_lista":
                $rewrite = "";
                if ($id_lista == "")
                    $id_lista = "novo";

                if ($sub_from == "") {
                    $tipo = "lista";
                    $id_lista = $this->pageModel->atualizaLista($id_lista, $id_user, $sub_from, $value, $tipo);
                    $rewrite = "<a href=\"#\" class=\"minimizar\" ttemp=\"0\"> - </a>";
                    $rewrite .= "<input type=\"text\" class=\"listas lista\" id=\"" . $id_lista . "_" . $sub_from . "\" value=\"" . $value . "\">";
                } else {
                    $tipo = "tarefa";
                    $id_lista = $this->pageModel->atualizaLista($id_lista, $id_user, $sub_from, $value, $tipo);
                    $rewrite .= "<input type=\"text\" class=\"listas\" id=\"" . $id_lista . "_" . $sub_from . "\" value=\"" . $value . "\">";
                }
                $rewrite .= "<a href=\"#\" class=\"del\">Xx</a> ";
                $rewrite .= "<a href=\"#\" class=\"add_tarefa\">++</a>";
                if ($sub_from != "")
                    $rewrite .= "<br>Data final: " . $this->inserirSelect($id_lista) . "<br><br>";
                else
                    $rewrite .= "<br><br>";
                $this->busca($id_lista, 0);
                $rewrite .= $this->document_tarefa;
                return $rewrite;
                break;
            case "click_del":
                if ($id_lista != "")
                    $this->pageModel->deletaSubTarefa($id_lista);
                break;
            case "select_time":
                $ano = $_POST['ano'];
                $mes = $_POST['mes'];
                $dia = $_POST['dia'];
                $hora = $_POST['hora'];
                $min = $_POST['min'];
                $date = "$ano-$mes-$dia $hora:$min:00";
                $this->pageModel->setDataFinal($id_lista, $date);
                $rewrite = "<input type=\"text\" class=\"listas\" id=\"" . $id_lista . "_" . $sub_from . "\" value=\"" . $value . "\">";
                $rewrite .= "<a href=\"#\" class=\"del\">Xx</a> ";
                $rewrite .= "<a href=\"#\" class=\"add_tarefa\">++</a>";
                $rewrite .= "<br>Data final: " . $this->inserirSelect($id_lista) . "<br><br>";

                $this->busca($id_lista, 0);
                $rewrite .= $this->document_tarefa;
                return $rewrite;
                break;
            case "concluir":
                if ($this->pageModel->concluiTarefa($id_lista, $id_user)) {
                    $rewrite = $this->listasUser($value);
                } else {
                    $rewrite = "erro na conclus&atilde;o";
                }
                return $rewrite;
                break;
        }
    }

    private function inserirSelect($id_lista) {
        $date = $this->pageModel->getDataFinal($id_lista);
//        echo "date = $date<br>";
        $ano = substr($date, 0, 4);
//        echo "ano = $ano<br>";
        $mes = substr($date, 5, 2);
//        echo "mes = $mes<br>";
        $dia = substr($date, 8, 2);
//        echo "dia = $dia<br>";

        $hora = substr($date, 11, 2);
//        echo "hora = $hora<br>";
        $min = substr($date, 14, 2);
//        echo "min = $min<br>";
        //-----select ano
        $select = "<select id=\"select_y\" class=\"select_time\">";
        if ($ano == "0000")
            $select .= "<option value=\"0000\" selected=\"true\">-</option>";
        else
            $select .= "<option value=\"0000\">-</option>";
        for ($i = date("Y"); $i < date("Y") + 26; $i++) {
            if ($ano == $i)
                $select .= "<option selected=\"true\" value=\"$i\">$i</option>";
            else
                $select .= "<option value=\"$i\">$i</option>";
        }

        //-----select mes
        $select .="</select>
                    <select id=\"select_m\" class=\"select_time\">";
        if ($mes == 00)
            $select .= "<option value=\"00\" selected=\"true\">-</option>";
        else
            $select .= "<option value=\"00\">-</option>";
        for ($i = 1; $i < 13; $i++) {
            if ($mes == $i)
                $select .= "<option selected=\"true\" value=\"$i\">$i</option>";
            else
                $select .= "<option value=\"$i\">$i</option>";
        }
        //-----select dia
        $select .= "</select>
                    <select id=\"select_d\" class=\"select_time\">";
        if ($dia == 00)
            $select .= "<option value=\"00\" selected=\"true\">-</option>";
        else
            $select .= "<option value=\"00\">-</option>";
        for ($i = 1; $i < 32; $i++) {
            if ($dia == $i)
                $select .= "<option selected=\"true\" value=\"$i\">$i</option>";
            else
                $select .= "<option value=\"$i\">$i</option>";
        }

        //-----select hora
        $select .="</select>
                    <select id=\"select_h\" class=\"select_time\">";
        if ($hora == 00)
            $select .= "<option value=\"00\" selected=\"true\">-</option>";
        else
            $select .= "<option value=\"00\">-</option>";
        for ($i = 0; $i < 24; $i++) {
            if ($hora == $i)
                $select .= "<option selected=\"true\" value=\"$i\">$i</option>";
            else
                $select .= "<option value=\"$i\">$i</option>";
        }

        //-----select min
        $select .="</select>
                    <select id=\"select_min\" class=\"select_time\">";
        if ($min == 00)
            $select .= "<option value=\"00\" selected=\"true\">-</option>";
        else
            $select .= "<option value=\"00\">-</option>";
        for ($i = 0; $i < 60; $i++) {
            if ($i < 10)
                $a = "0";
            else
                $a = "";
            if ($min == $i)
                $select .= "<option selected=\"true\" value=\"$i\">$a$i</option>";
            else
                $select .= "<option value=\"$i\">$a$i</option>";
        }
        $select .="</select>";
        return $select;
    }

    function listaTarefas($id_user) {
        $atrasadas = $this->pageModel->listaTarefasAtrasadas($id_user);
        $dia = $this->pageModel->listaTarefasDia($id_user);
    }

    function criaLista($id_user) {
        $atrasadas = $this->pageModel->listaTarefasAtrasadas($id_user);
        $dia = $this->pageModel->listaTarefasDia($id_user);
        $proximas = $this->pageModel->listaTarefasProxima($id_user);
        $result = "";
        $nodata = "";
        $temp = "";

        while ($tarefa = mysql_fetch_object($atrasadas)) {
            if ($tarefa->tipo != "lista" && $tarefa->data_conclusao == "0000-00-00 00:00:00") {
                $lista = $this->pageModel->subFromLista($tarefa->sub_from);
                if (substr($tarefa->data_final, 0, 10) != "0000-00-00") {
                    $temp .= "<div class=\"news_content\"><p>" . $tarefa->conteudo . "</p>
                    <p>Da lista: $lista->conteudo</p>
                    <p class=\"red\">" . $tarefa->data_final . "</p></div>";
                } else {
                    $nodata .= "<div class=\"news_content\"><p>" . $tarefa->conteudo . "</p>
                    <p>Da lista: $lista->conteudo</p>
                    <p> </p></div>";
                }
            }
        }
        if ($temp != "")
            $result .="<p class=\"red t_class\">Atrasadas</p>";
        else
            $temp = "<p class=\"red s_class\">Voc&ecirc; n&atilde;o tem tarefas atrasadas</p>";
        $result .= $temp;
        $temp = "";


        while ($tarefa = mysql_fetch_object($dia)) {
            if ($tarefa->tipo != "lista" && $tarefa->data_conclusao == "0000-00-00 00:00:00") {
                $lista = $this->pageModel->subFromLista($tarefa->sub_from);
                $temp .= "<div class=\"news_content\"><p>" . $tarefa->conteudo . "</p>
                    <p>Da lista: $lista->conteudo</p>
                    <p class=\"yellow\">" . $tarefa->data_final . "</p></div>";
            }
        }
        if ($temp != "")
            $result .="<p class=\"yellow t_class\">Para hoje</p>";
        else
            $temp = "<p class=\"yellow s_class\">Voc&circ; n&atilde;o tem tarefas para hoje</p>";
        $result .= $temp;
        $temp = "";


        while ($tarefa = mysql_fetch_object($proximas)) {
            if ($tarefa->tipo != "lista" && $tarefa->data_conclusao == "0000-00-00 00:00:00") {
                $lista = $this->pageModel->subFromLista($tarefa->sub_from);
                $temp .= "<div class=\"news_content\"><p>" . $tarefa->conteudo . "</p>
                    <p>Da lista: $lista->conteudo</p>
                    <p class=\"green\">" . $tarefa->data_final . "</p></div>";
            }
        }
        if ($temp != "")
            $result .="<p class=\"green t_class\">Pr&oacute;ximas</p>";
        else
            $temp = "<p class=\"green s_class\">Voc&ecirc; n&atilde;o tem tarefas agendadas</p>";
        $result .= $temp;
        $temp = "";

        if ($nodata != "")
            $result .="<p class=\"t_class\">Sem datas</p>";
        
        $result .= $nodata;
        return $result;
    }

}

?>

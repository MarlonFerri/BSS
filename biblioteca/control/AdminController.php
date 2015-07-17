<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author Marlon Jean Ferri
 */
class AdminController {

    //put your code here
    private $id_admin = "";
    private $pass_admin = "";
    private $admin;
    private $adminModel;
    private $pagina;
    private $_param;

    public function __construct($pag, $param) {
        $this->adminModel = new AdminModel();
        $this->adminModel->initConfig();
        $this->adminModel->connect();
        $this->pagina = $pag;
        $this->_param = $param;
        if (isset($_SESSION['iu']) && isset($_SESSION['pu'])) {
            $this->id_admin = $_SESSION['iu'];
            $this->pass_admin = $_SESSION['pu'];

            if ($this->adminModel->localizaAdmin($this->id_admin, $this->pass_admin)) {
                
            } else {
//                echo "id = " . $this->id_admin . "<br>senha = " . $this->pass_admin;
                header("Location: " . URL);
            }
        } else {
//            echo "id = " . $this->id_admin . "<br>senha = " . $this->pass_admin;
            header("Location: " . URL);
        }
    }

    /*
     * Função para criar conteúdo, guardando o arquivo em pasta e informações no banco
     */

    function createContent() {
        switch ($this->pagina) {
            case "home":
                return "home";
                break;
            case "home/request":
                return "home";
                break;
            case "paginas":
                return "paginas";
                break;

            case "conteudos":

                $full_content = $this->loadAdminPag($this->pagina);
                $result = $this->adminModel->getConteudos($this->_param[2]);

                $cor = 0;
                $content = "";
                while ($conteudo = mysql_fetch_object($result)) {
                    if ($cor == 0) {
                        $content .= "<tr>";
                        $cor = 1;
                    } else {
                        $content .= "<tr class=\"blue\">";
                        $cor = 0;
                    }
                    $content .= "<td>$conteudo->c_nome</td>";
                    $content .= "<td>$conteudo->c_pag</td>";
                    $content .= "<td>$conteudo->c_ref</td>";
                    $content .= "<td>$conteudo->c_modelo</td>";
//                    $content .= "<td>$conteudo->c_conteudo</td>";
//                    $content .= "<td>$conteudo->c_conteudo2</td>";
//                    $content .= "<td>$conteudo->c_img_ref</td>";
//                    $content .= "<td>$conteudo->c_img</td>";
//                    $content .= "<td>$conteudo->c_img2</td>";
//                    $content .= "<td> 
//                    <a  class=\"b_edit_conteudo\" id=\"edit_$conteudo->id\"><img src=\"../../imgs/icons/wrench.png\"></a>
//                    <a  class=\"b_delete_conteudo\" id=\"del_$conteudo->id\"><img src=\"../../imgs/icons/delete.png\"></a>
//                    <a  class=\"b_edit_imagem\" id=\"img_$conteudo->id\"><img src=\"../../imgs/icons/picture_edit.png\"></a>
//                    </td></tr>";

                    $content .= "<td> 
                    <a  class=\"b_edit_conteudo\" id=\"edit_$conteudo->id\"><img src=\"../../imgs/icons/wrench.png\"></a>
                    <a  class=\"b_delete_conteudo\" id=\"del_$conteudo->id\"><img src=\"../../imgs/icons/delete.png\"></a>
                    </td></tr>";
                }
                $full_content = str_replace("<conteudo_tabela></conteudo_tabela>", $content, $full_content);
                $full_content = str_replace("<pag_conteudo></pag_conteudo>", $this->_param[2], $full_content);

                return $full_content;
                break;

            case "usuarios":
                return "usuarios";
                break;

            case "emails":
                return "emails";
                break;

            case "textos":
                return "textos";
                break;

            case "estatisticas":
                return "estatisticas";
                break;
        }
    }

    /*
     * função para criação de págians internas do admin, carregando o .mtl apropriado
     */

    function loadAdminPag($pag) {
        $filename = "biblioteca/view/pag/admin/$pag.mtl";
        if (file_exists($filename)) {
            $cont = file_get_contents($filename);
            return $cont;
        } else {
            return false;
        }
    }

    /*
     * função para request do admin
     * primeiro case server para averiguar qual página do admin pediu request
     * segundo case para ver qual ação daquela página foi necessária
     */

    function adminRequest() {
        switch ($this->pagina) {
            case "conteudos":
                if (isset($_POST['acao']))
                    $acao = $_POST['acao'];
                else
                    $acao = $_GET['acao'];
                switch ($acao) {
                    case "editar":
                        $conteudo = $this->adminModel->getConteudo($_POST["id"]);
                        $final = "<div class=\"fechar_campos\">[x]</div>
                            <form method=\"post\" action=\"../../admin/conteudos/home/request\" enctype=\"multipart/form-data\">
                            
                                <div class=\"edit_top\">
                                    <input type=\"hidden\" value=\"salvar\" id=\"acao\" name=\"acao\">
                                    <input type=\"hidden\" value=\"$conteudo->id\" id=\"f_id\" name=\"f_id\">
                                    <div class=\"img_box img_ref_box\">
                                        <input id=\"filesref\" class=\"img_file img_ref_box\" type=\"file\" name=\"i_r\">
                                        <img id=\"filesref_image\" class=\"img_preview img_ref_box\" src=\"../../imgs/conteudos/$conteudo->c_img_ref\">
                                    </div>

                                    <div class=\"edit_names\">
                                        <label>Nome: </label>
                                        <input type=\"text\" name=\"f_nome\" value=\"$conteudo->c_nome\" /><br>
                                        <label>Referencia: </label>
                                        <input type=\"text\" name=\"f_ref\" value=\"$conteudo->c_ref\"/><br>
                                        <label>P&aacute;gina: </label>
                                        <input type=\"text\" readonly=\"true\" name=\"f_pag\" value=\"$conteudo->c_pag\"/><br>
                                        <label>Link: </label>
                                        <input type=\"text\" name=\"f_link\" value=\"$conteudo->c_link\"/><br>   
                                        <label>Modelo: </label>
                                        <select name=\"f_model\" class=\"s_models\">
                                            <!--<select_models></select_models>-->
                                            <option value=\"1\">1</option>
                                            <option value=\"2\">2</option>
                                            <option value=\"3\">3</option>
                                        </select>
                                    </div>

                                </div>
                                <div class=\"edit_modelo\" class=\"vermelho\">
                                    <div class=\"edit_esq\">

                                        <div class=\"img_box\">
                                            <input id=\"files1\" class=\"img_file\" type=\"file\" name=\"i_e\">
                                            <img id=\"files1_image\" class=\"img_preview\" src=\"../../imgs/conteudos/$conteudo->c_img1\">
                                        </div>
                                        <textarea class=\"t_esq\" name=\"f_e\" >$conteudo->c_conteudo1</textarea>
                                    </div>
                                    <div class=\"edit_cen\">

                                        <div class=\"img_box\">
                                            <input id=\"files2\" class=\"img_file\" type=\"file\" name=\"i_c\">
                                            <img id=\"files2_image\" class=\"img_preview\" src=\"../../imgs/conteudos/$conteudo->c_img2\">
                                        </div>
                                        <textarea class=\"t_cen\" name=\"f_c\" >$conteudo->c_conteudo2</textarea>
                                    </div>
                                    <div class=\"edit_dir\">

                                        <div class=\"img_box\">
                                            <input id=\"files3\" class=\"img_file\" type=\"file\" name=\"i_d\">
                                            <img id=\"files3_image\" class=\"img_preview\" src=\"../../imgs/conteudos/$conteudo->c_img3\">
                                        </div>
                                        <textarea class=\"t_dir\" name=\"f_d\" >$conteudo->c_conteudo3</textarea>
                                    </div>
                                </div>
                                <input class=\"salvar\" type=\"submit\" value=\"Salvar\">
                            </form>";
                        echo $final;
                        break;
                    case "excluir":
                        $id = $_POST['id'];
                        $target = $this->adminModel->getConteudo($id);
                        if ($target) {
                            echo "Conteúdo encontrado id = $target->id";
                            $error = 0;
                            $pasta = "imgs/conteudos/";
                            $f_r = $pasta . $target->c_img_ref;
                            $f_e = $pasta . $target->c_img1;
                            $f_c = $pasta . $target->c_img2;
                            $f_d = $pasta . $target->c_img3;

                            //Excluir fotos
                            //foto ref
                            if (file_exists($f_r))
                                if (!unlink($f_r))
                                    $error++;
                            if (file_exists($f_e))
                                if (!unlink($f_e))
                                    $error++;
                            if (file_exists($f_c))
                                if (!unlink($f_c))
                                    $error++;
                            if (file_exists($f_d))
                                if (!unlink($f_d))
                                    $error++;
                            //Excluir banco
                            if ($error == 0) {
                                $target = $this->adminModel->excluiConteudo($target->id);
                                if ($target)
                                    echo "Conteúdo excluído com sucesso";
                                else {
                                    $error = $error + 10;
                                    echo "Erro ao excluir banco. Erro = $error";
                                }
                            } else {
                                echo "Erro ao excluir arquivos. Erro = $error";
                            }
                        } else {
                            echo "Conteúdo não encontrado id = $id";
                        }
//                        header("Location: " . $_SERVER['HTTP_REFERER'] . "");
                        break;
                    case "salvar":
                        $id = $_POST['f_id'];
                        $nome = $_POST['f_nome'];
                        $ref = $_POST['f_ref'];
                        $link = $_POST['f_link'];
                        $modelo = $_POST['f_model'];
                        $t_esq = $_POST['f_e'];
                        $t_cen = $_POST['f_c'];
                        $t_dir = $_POST['f_d'];
//                        $pag = $_POST['f_pag'];
                        $pag = "home";


                        $pasta = "imgs/conteudos/";
                        //echo "Upload entrado";
                        $filenameref = $pasta . $_FILES["i_r"]['name'];
                        $filename1 = $pasta . $_FILES["i_e"]['name'];
                        $filename2 = $pasta . $_FILES["i_c"]['name'];
                        $filename3 = $pasta . $_FILES["i_d"]["name"];
//////////////////////////////////////////////////////////
                        if ($id != "new") {

//                            if ($_FILES['f_img']['tmp_name'] != "") {
//                                //deleta imagem atual                            
//                            }
//
//                            if ($_FILES['f_img2']['tmp_name'] != "") {
//                                //deleta imagem atual                            
//                            }
                            $acao = "edit";
                        } else {
                            $acao = "add";
                        }

                        if (file_exists($filenameref) && $_FILES['i_r']['tmp_name'] != "") {
                            $extensao = strtolower(end(explode('.', $_FILES['i_r']['name'])));
                            $filenameref = md5(date("hh:mm") . $_FILES["i_r"]['tmp_name']) . "." . $extensao;
                        }
                        else
                            $filenameref = $_FILES["i_r"]['name'];

                        if (file_exists($filename1) && $_FILES['i_e']['tmp_name'] != "") {
                            $extensao = strtolower(end(explode('.', $_FILES['i_e']['name'])));
                            $filename1 = md5(date("hh:mm") . $_FILES["i_e"]['tmp_name']) . "." . $extensao;
                        }
                        else
                            $filename1 = $_FILES["i_e"]['name'];

                        if (file_exists($filename2) && $_FILES['i_c']['tmp_name'] != "") {
                            $extensao = strtolower(end(explode('.', $_FILES['i_c']['name'])));
                            $filename2 = md5(date("hh:mm") . $_FILES["i_c"]['tmp_name']) . "." . $extensao;
                        }
                        else
                            $filename2 = $_FILES["i_c"]['name'];

                        if (file_exists($filename3) && $_FILES['i_d']['tmp_name'] != "") {
                            $extensao = strtolower(end(explode('.', $_FILES['i_d']['name'])));
                            $filename3 = md5(date("hh:mm") . $_FILES["i_d"]['tmp_name']) . "." . $extensao;
                        }
                        else
                            $filename3 = $_FILES["i_d"]['name'];






//aqui função de salvar arquivo
                        $error_up = 0;
                        if ($_FILES['i_r']['tmp_name'] != "") {
                            if (!move_uploaded_file($_FILES['i_r']['tmp_name'], $pasta . $filenameref))
                                $error_up++;
                        }
                        if ($_FILES['i_e']['tmp_name'] != "") {
                            if (!move_uploaded_file($_FILES['i_e']['tmp_name'], $pasta . $filename1))
                                $error_up++;
                        }
                        if ($_FILES['i_c']['tmp_name'] != "") {
                            if (!move_uploaded_file($_FILES['i_c']['tmp_name'], $pasta . $filename2))
                                $error_up++;
                        }
                        if ($_FILES['i_d']['tmp_name'] != "") {
                            if (!move_uploaded_file($_FILES['i_d']['tmp_name'], $pasta . $filename3))
                                $error_up++;
                        }


                        if ($error_up == 0) {
                            if ($acao == "add") {
//                                $this->adminModel->initConfig();
//                                $this->adminModel->connect();
                                $result = $this->adminModel->addConteudo($nome, $ref, $pag, $link, $modelo, $t_esq, $t_cen, $t_dir, $filenameref, $filename1, $filename2, $filename3);
                            } else {
                                $result = $this->adminModel->editConteudo($id, $nome, $ref, $pag, $link, $modelo, $t_esq, $t_cen, $t_dir, $filenameref, $filename1, $filename2, $filename3);
                            }
                        }
                        else
                            echo "<script>alert(\"Erro ao fazer upload do arquivo \");</script>";
                        ///////////////////////////////////////////////////
                        if ($result)
                            echo "<script>alert(\"Upload realizado\");</script>";
                        else
                            echo "<script>alert(\"Erro de upload $error_up \");</script>";

                        header("Location: " . $_SERVER['HTTP_REFERER'] . "");
                        break;

                    case "editar_function":
                        $a = $_POST["class2"];
                        if ($a == "vermelho") {
                            echo "azul";
                        }
                        else
                            echo "vermelho";
                        break;
                }

                break;
            case "emails":
                echo "eh...tah aki;";
                break;
            case "salvar_conteudo":
                $id = $_POST['f_id'];
                echo "<script>alert(\"por aki  $id  \");</script>";
                break;
        }
    }

}

?>

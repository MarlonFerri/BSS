<?php

/*
 * Classe control responsável pela manipulação do conteúdo para todas as páginas
 * do framework. 
 * @autor Marlon Ferri <marlonjferri@gmail.com>
 */

class IndexController extends BaseController {
    /*
     * Variável que recebe o valor da página requerida pela URL
     * @access private
     */

    private $pagina;

    /*
     * Variável que recebe os valores existentes na URL em forma de array
     * @access public
     */
    public $_param;

    /*
     * Função construct da classe.
     * Sua primeira função é dividir o conteúdo da URL em um array $_param e testar se o
     * primeiro parâmetro corresponde de forma correta a um arquivo .mtl da página desejada.
     * Em caso afirmativo chama a função loadAction() para iniciar o método apropriado para a página.
     * Também é aqui que chamamos o método initModel();
     * @author Marlon Ferri <marlonjferri@gmail.com>
     */

    function __construct() {
        $this->_param = (isset($_GET["pag"])) ? $_GET["pag"] : "home/";

        //echo "meu inicial �: -------->".$this->_param;
        if (substr($this->_param, -1) != "/")
            $this->_param .= "/";
        $pasta = "biblioteca/view/pag";
        if (substr_count($this->_param, "/") > 0) {
            $this->_param = explode("/", $this->_param);
            $this->pagina = (file_exists("{$pasta}/" . $this->_param[0] . "/" . $this->_param[0] . ".mtl")) ? $this->_param[0] : "erro";
        } else {
            $this->pagina = (file_exists("{$pasta}/" . $this->_param . ".mtl")) ? $this->_param : "erro";
        }
        $this->initModel(); //suprimir esta linha caso n�o haja banco de dados.
        session_start();


        if (in_array("request", $this->_param))
            $this->loadAction($this->pagina, "request");
        else
            $this->loadAction($this->pagina, "true");
    }

    /*
     * Função para acesso externo ao array $_param[]
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @param Int $n
     * @return String
     */

    public function param($n) {
        return $this->_param[$n];
    }

    /*
     * Função para iniciar o objeto model da classe BaseModel, responsável pela
     * comunicação primária com o banco de dados. É possível enviar as var de conexão
     * via o parâmetro $config ou deixar em branco para que o objeto use o arquivo padrão
     * Essa função é chamada pelo construtor dessa classe.
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @param String $config
     * @return void
     */

    public function initModel($config) {
        $this->model = new BaseModel($this->pagina);
        $this->model->initConfig($config);
    }

    /*
     * Função que inicia a conexão e envia para o objeto model as conficurações
     * padrões.
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    public function loadModel() {
        $this->view->connection = $this->model->connect();
        $this->view->initVar('metaDefault', $this->model->loadDefaultObject());
    }

    private function mosaico() {
        $this->homeModel = new HomeModel($this->pagina);
        $pag = 1;
        $content = "";
        while ($this->homeModel->loadMosaicoItem("b1_p$pag")) {
            $content .= "<div class=\"nav_painel\" id=\"nav_p$pag\">";

            $target = $this->homeModel->loadMosaicoItem("b1_p$pag");
            $content .= $this->itemMosaico("b1_p", $target->c_img_ref, $target->id);

            $target = $this->homeModel->loadMosaicoItem("b2_p$pag");
            $content .= $this->itemMosaico("b2_p", $target->c_img_ref, $target->id);

            $target = $this->homeModel->loadMosaicoItem("b3_p$pag");
            $content .= $this->itemMosaico("b3_p", $target->c_img_ref, $target->id);

            $target = $this->homeModel->loadMosaicoItem("b4_p$pag");
            $content .= $this->itemMosaico("b4_p", $target->c_img_ref, $target->id);

            $target = $this->homeModel->loadMosaicoItem("b5_p$pag");
            $content .= $this->itemMosaico("b5_p", $target->c_img_ref, $target->id);

            $target = $this->homeModel->loadMosaicoItem("b6_p$pag");
            $content .= $this->itemMosaico("b6_p", $target->c_img_ref, $target->id);

            $target = $this->homeModel->loadMosaicoItem("b7_p$pag");
            $content .= $this->itemMosaico("b7_p", $target->c_img_ref, $target->id);

            $content .= "</div>";
            $pag++;
        }

        return $content;
    }

    private function itemMosaico($ref, $img, $id) {
        if ($ref == "b7_p")
            $bloco = "bloco_2";
        else
            $bloco = "bloco_1";

        return "<div class=\"$bloco espaco_painel\" id=\"$id\">
                    <img class=\"img_conteudo\" src=\"imgs/conteudos/$img\">                
                    <div class=\"nav_img\">
                        <img class=\"nuvem_box\" src=\"imgs/protect_box.png\">
                    </div>
                </div>";
    }

    /*
     * Função padrão para o caso de a página requisitada não existir.
     * Essa função é chamada pelo construtor dessa classe. Abre página de erro 404 personalizada.
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function erroAction() {
        $this->view->initView($this->pagina);
        $this->loadModel();

        $this->view->initCss();
        $this->view->render();
    }

    /*     * **********************************  Site pages Actions and Requests
     * Insira abaix as funções Action e Request para as páginas criadas,
     * para que possam ser chamadas pelo construtor desta classe.
     */


    /*
     * Função para a página contato
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function contatoAction() {
        $this->view->initView($this->pagina);
        $this->loadModel();

        $this->view->initCss();
        $this->view->render();
    }

    /*
     * Função para a página home
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function homeAction() {
        if ($this->_param[1] == "box") {
            $id = $_POST['id'];
//            switch ($p) {
//                case "b1_p1":
//                    $p = "quem_somos";
//                    break;
//            }
//            $pageView = new PageView($p);
//            $filename = "biblioteca/view/pag/" . $p . "/box_" . $p . ".mtl";
//            echo $filename;
//            if (file_exists($filename)) {
//                $pageView->boxRender();
//            } else {
//                $texto = "Sem vers&atilde;o simplificada da p&aacute;gina";
//            }
            $this->loadModel();
            $this->homeModel = new HomeModel($this->pagina);
            $target = $this->homeModel->loadMosaicoBox($id);

            // c    olocar aki código que gera os dados pra página do box
            // não esquecer de ponderar o modelo
            // desenvolver modelo padrão
//            $box_content = "<div class=\"content_box\">";
//            $box_content .=
//            $box_content .= "</div>";

            $box_content .= "<div class=\"box_col\">";
            $box_content .= $target->c_conteudo1;
            if ($target->c_img1 != "")
                $box_content .="<img id=\"ie_$target->c_modelo\" src=\"imgs/conteudos/$target->c_img1\">";
            $box_content .= "</div>";

            $box_content .= "<div class=\"box_col\">";
            $box_content .= $target->c_conteudo2;
            if ($target->c_img2 != "")
                $box_content .="<img id=\"ic_$target->c_modelo\" src=\"imgs/conteudos/$target->c_img2\">";
            $box_content .= "</div>";

            $box_content .= "<div class=\"box_col\">";
            $box_content .= $target->c_conteudo3;
            if ($target->c_img3 != "")
                $box_content .="<img id=\"id_$target->c_modelo\" src=\"imgs/conteudos/$target->c_img3\">";
            $box_content .= "</div>";

            echo $box_content;
            
        } else {
            $this->view->initView($this->pagina);
            $this->loadModel();

            $this->view->initCss();
            $this->view->addJs("shadowbox");
            $this->view->addJs("bg_roller");
            $this->view->addJs("home_login");
            $this->view->addJs("painel");
            $mosaico = $this->mosaico();
            $this->view->initVar("mosaico", $mosaico);
            $this->view->render();
        }
    }

    /*
     * Função para request da página home
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    public function homeRequest() {
        
    }

    /*
     * Função para a página registro_user
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function registro_userAction() {
        $this->loadModel();
        if (!$this->_param[1] == "registro") {
            $this->view->initView($this->pagina);
            $this->view->initCss();
            $this->view->addJs("valida_registro");
            $this->view->addJs("shadowbox");
            $this->view->render();
        } else {
            $this->view->addJs("jquery");
            $this->pageModel = new RegistroModel();
            $email = $this->stripAll($_POST['email_reg']);
            $senha = $this->stripAll($_POST['senha_c_reg']);
            $nome = $this->stripAll($_POST['nome_reg']);

            //colocar aqui fun��o para email de confirma��o!!!!
            $mailer = new EmailController($this->model->loadDefaultObject(), $email, $nome);
            $codigo = md5($email . date() . time());
            if ($mailer->emailConfirmacao($codigo, "default")) {
                $this->view->initView("registro_send");
                $this->pageModel->registrarUser($email, $senha, $nome, $codigo);
            }
            else
                $this->view->initView("registro_error_send");

            $this->view->initCss();
            $this->view->addCss("home");
            $this->view->render();
        }
    }

    /*
     * Função para request da página registro_user
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function registro_userRequest() {
        $this->model->connect();
        $this->view = new PageView($this->pagina);
        $campo = $this->stripAll($_POST['nome_campo']);
        $val = $this->stripAll($_POST['val_campo']);
        $this->pageModel = new RegistroModel();


        switch ($campo) {
            case "nome_re":
                //$retorno = $this->pageModel->checkNome();
                $texto = "Nome ok<script>$('#nome_hidden').attr('value', 'ok');</script>";
                $this->view->simpleRender($texto);
                break;
            case "login_re":
                $retorno = $this->pageModel->checkEmail($val);
                if ($this->pageModel->checkEmail($val))
                    $texto = "Este email j&aacute; est&aacute; cadastrado!<script>$('#login_hidden').attr('value', 'off');</script>";
                else {
                    if (filter_var($val, FILTER_VALIDATE_EMAIL))
                        $texto = "Email aceito!<script> $('#login_hidden').attr('value', 'ok');</script>";
                    else
                        $texto = "Favor digite um email v&aacute;lido!<script>$('#login_hidden').attr('value', 'off');</script>";
                }
                $this->view->simpleRender($texto);


                break;
            case "senha1_re":
                //$retorno = $this->pageModel->checkSenha1();
                if (strlen($val) < 8)
                    $texto = "A senha deve conter no m&iacute;nimo 8 digitos!<script>$('#senha1_hidden').attr('value', 'off');</script>";
                else
                    $texto = "Senha aceita!<script> $('#senha1_hidden').attr('value', 'ok');</script>";

                $this->view->simpleRender($texto);
                break;
            case "senha2_re":
                //$retorno = $this->pageModel->checkSenha2();

                $val = explode("##", $val);

                if ($val[0] != $val[1])
                    $texto = "As duas senhas n&atilde;o s&atilde;o iguais!<script>$('#senha2_hidden').attr('value', 'off');</script>";
                else
                    $texto = "Senha aceita!<script>$('#senha2_hidden').attr('value', 'ok');</script>";
                $this->view->simpleRender($texto);
                break;
            case "check_re":
                $texto = "<script>$('#termos_hidden').attr('value', 'ok');</script>";
                $this->view->simpleRender($texto);
                break;
        }
    }

    /*
     * Função para a página login_user
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function login_userAction() {
        //teste de login
        $this->model->connect();
        $this->pageModel = new UserModel($this->pagina);
        if (isset($_POST['login_bss']) && isset($_POST['senha_bss'])) {
            $login = $this->stripAll($_POST['login_bss']);
            $senha = $this->stripAll($_POST['senha_bss']);
            if ($this->pageModel->checkLogin($login, $senha)) {
                //$user = $this->pageModel->loadUser();
                $id = $this->pageModel->getIdUser();
                $_SESSION['iu'] = $id;
                $_SESSION['pu'] = md5($this->stripAll($_POST['senha_bss']));
                if ($this->pageModel->checkTipo() == "admin")
                    header("Location: " . URL . "/admin/home");
                else
                    header("Location: " . URL . "/start/" . $id . "/");
                //header("Location: " . URL . "/start/");
            } else {
                //mensagem de login error
                $this->view->initView($this->pagina);
                $this->view->initCss();
                $this->view->render();
            }
        } else {
            if (isset($_SESSION['iu']) && isset($_SESSION['pu'])) {
                //echo $_SESSION['iu'];
                if ($this->pageModel->checkLoginId($_SESSION['iu'], $_SESSION['pu'])) {
                    //$id = $this->pageModel->getIdUser();
                    header("Location: " . URL . "/start/" . $_SESSION['iu']);
                } else {
                    $this->view->initView($this->pagina);
                    $this->view->initCss();
                    $this->view->render();
                }
            } else {
                $this->view->initView($this->pagina);
                $this->view->initCss();
                $this->view->render();
//            header("Location: " . URL);
            }
        }
    }

    /*
     * Função para a página start
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function startAction() {
        $this->view->initView($this->pagina);
        $this->loadModel();

        $user = new UserController($this->pagina);
        $user_dados = $user->findUser($this->param(1));
        if (!is_object($user_dados))
            header("Location: " . URL);
        else
            $this->view->initVar("user_dados", $user_dados);

        //----
        $id_user = $_SESSION['iu'];
        $this->view->addJs("start");
//        $this->view->addJs("jquery.lockeys");
        $this->view->addJs("menuRight");
        $this->view->initCss();
        $this->view->render();
    }

    /*
     * Função para request da página start
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function startRequest() {
        $this->model->connect();

        $this->pageView = new StartView($this->pagina);
        $activit = $this->_param[4];
        $user = new UserController($this->pagina);
        switch ($activit) {
            case "listar":
                $lista = $user->criaLista($this->_param[1]);
                $this->pageView->mostraLista($lista);
                break;
            case "atualizar":
                $this->pageView->atualisaLista($this->_param);
                break;
        }
    }

    /*
     * Função para a página confirmacao
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function confirmacaoAction() {
        $this->model->connect();
        $this->pageModel = new UserModel();
        $this->view->initView($this->pagina);

        $resultado = $this->pageModel->confirmaUser($this->_param[1]);

        if (is_object($resultado)) {
            $texto = $resultado->user_nome . " Sua confirma&ccedil;&atilde;o est&aacute; concluida!";
            $texto2 = "Em breve estaremos colocando no ar v&aacute;rios m&oacute;dulos para voc&ecirc; alcan&ccedil;ar teus objetivos!";
        } else {
            $texto = "C&oacute;digo n&atilde;o encontrado!";
            $texto2 = "Para sua maior comodidade, utilize o link que enviamos diretamente para o teu email.";
        }

        $this->view->initVar("confirmacao", $resultado->user_codigo_confirmacao); //fica em branco caso n�o encontre o c�digo
        $this->view->initVar("resultado", $texto);
        $this->view->initVar("mensagem", $texto2);
        $this->view->initCss();
        $this->view->addCss("home");
        $this->view->addCss("registro_user");
        $this->view->render();
    }

    /*
     * Função para a página listas
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function listasAction() {
        $this->view->initView($this->pagina);
        $this->loadModel();

        $user = new UserController($this->pagina);
        $user_dados = $user->findUser($this->param(1));
        if (!is_object($user_dados))
            header("Location: " . URL);
        else
            $this->view->initVar("user_dados", $user_dados);
        $this->view->initVar("listas_user", $user->listasUser());
        $this->view->initCss();
        $this->view->addCss("start");
        $this->view->addJs("listas_refresh");
        $this->view->render();
    }

    /*
     * Função para request da página listas
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function listasRequest() {
        $this->model->connect();
        $value = $this->stripAll($_POST['value']);
        $id_lista = $this->stripAll($_POST['id']);
        $sub_from = $this->stripAll($_POST['sub_from']);
        $id_user = $_SESSION['iu'];
        $user = new UserController($this->pagina);
        $user_dados = $user->findUser($_SESSION['iu']);
        $texto = $user->requestLista($id_lista, $id_user, $value, $sub_from, $this->_param[4]);

        $pageView = new PageView($this->pagina);
        $pageView->simpleRender($texto);
    }

    /*
     * Função para a página objetivos
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function objetivosAction() {
        $this->view->initView($this->pagina);
        $this->loadModel();
//        $this->view->addJs("mensagens2");
        $this->view->addJs("rules.mensagens");
        $this->view->addJs("mensagens2");
        $this->view->initCss();
        $this->view->render();
    }

    /*
     * Função para request da página objetivos
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function objetivosRequest() {
//        echo $this->_param[2]. "<br>";
        if ($this->_param[2] == "load") {
//            echo "chamou load request";
            echo "[a,d,c]";
        } else {
            echo $this->pagina . "<br>" . $this->stripAll($_POST["acao"]);

            echo "chegou ateh o request";
        }
    }

    /*
     * Função para a página logout_user
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function logout_userAction() {
        unset($_SESSION['iu']);
        unset($_SESSION['pu']);
        header("Location: " . URL);
    }

    /*
     * Função para a página blog
     * Irá redirecionar o usuário para o blog wordpress do site
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function blogAction() {
        include_once URL . '/blog/index.php';
    }

    /*
     * Função para a página admin
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function adminAction() {
        $this->model->connect();
        $adminController = new AdminController($this->_param[1], $this->_param);
        $this->view->initView($this->pagina);
        $this->view->initCss();
        $this->view->initVar("content", $adminController->createContent());
//        $this->view->initVar("pagina", $this->_param[1]);
        $this->view->addJs("admin_conteudos");
        $this->view->addCss("admin_home_modelos");
        $this->view->render();
    }

    /*
     * Função para request da página admin
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * 
     * @return void
     */

    function adminRequest() {
        $adminController = new AdminController($this->_param[1], $this->_param);
        $adminController->adminRequest();
    }

}

?>

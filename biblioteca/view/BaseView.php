<?php

/*
 * 
 */

class BaseView {

    public $pagina;
    public $pagina_content;
    public $connection;
    public $css;
    public $cssAdd;
    public $js;

    function __construct($p) {
        $this->pagina = $p;
        $this->js = "";
    }

    public function initView($p) {
        if (isset($p))
            $this->pagina_content = $p;
        else
            $this->pagina_content = $this->pagina;
    }

    public function render() {
        $this->header($this->css);
        echo "<body><div id=\"content\">";
        echo "<div id=\"fb-root\"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = \"//connect.facebook.net/pt_BR/all.js#xfbml=1\";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>";
        include ("biblioteca/view/pag/" . $this->pagina . "/" . $this->pagina_content . ".mtl");
        echo "</div></body>";
        
    }
    public function initCss($param) {
        if (isset($param))
            $this->css = "/biblioteca/view/style/$param.css";
        else
            $this->css = "/biblioteca/view/style/$this->pagina_content.css";
    }

    public function initVar($var, $val) {
        $this->$var = $val;
    }

    public function header($css) {
        if ($this->connection == false)
            include ("inc/configH.php");
        else {
            $tituloSite = $this->metaDefault->nome_empresa;
            $fraseConteudo = $this->metaDefault->frase_site;
            $descricaoSite = $this->metaDefault->descricao_site;
            $palavrasChave = $this->metaDefault->palavras_chave;
            //$lat_lon = $metadDefault->;
        }
        if(!isset($_css))
            $_css = $this->css;
        

        include ("biblioteca/view/pag/header.php");
        echo "<link rel = \"stylesheet\" type=\"text/css\" href=\"" . URL . "/biblioteca/view/style/standard.css\" />";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . URL . "/biblioteca/view/style/site.css\"/>";
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . URL . $_css . "\"/>";
        echo $this->cssAdd;

        echo "
        <script type=\"text/javascript\">
        URL = \"" . URL . "/\";
        PAG = \"" . $this->pagina . "\";
        </script>";

        echo $this->js;
        
        if ($this->pagina == "admin"){
            $filename = "inc/statics_admin.php";
            $cont = file_get_contents($filename);
            $cont = str_replace("URL", URL, $cont);
            echo $cont;
        }
        echo "
        <script type=\"text/javascript\">
        Shadowbox.init();
        
        </script>";
        echo "</head>";
    }

    public function addjs($js) {

        if (file_exists("js/$js.js") or die("Js n&atilde;o encontrado")) {
            $this->js .= "<script type=\"text/javascript\" src=\"" . URL . "/js/$js.js\"></script>";
            if (file_exists("css/$js.css"))
                $this->js .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . URL . "/css/$js.css\"/>";
        }else {
            //echo "n�o existe " . URL."/js/$js.js";
        }


        //$this->js .= $js;
    }

    function addCss($css) {
        if (file_exists("biblioteca/view/style/$css.css") or die("Css n&atilde;o encontrado")) {
            $this->cssAdd .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . URL . "/biblioteca/view/style/$css.css\"/>";
        }
    }

}

?>

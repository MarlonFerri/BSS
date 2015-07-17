<?php

class PageView extends BaseView {

    function __construct($p) {
        $this->pagina = $p;
        //echo "<br>Created<br>";
    }

    function simpleRender($texto) {
        //echo "<div style=\"background: #555;\">";
        $texto = stripLetters($texto);
        echo $texto;
        //echo "</div>";
    }

    function boxRender() {
        $texto = "<html><head>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
            ";
        $texto.= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . URL . "/biblioteca/view/style/boxContentHome.css\"/>";

        $texto.= "</head><body>";
        $texto.= file_get_contents("biblioteca/view/pag/$this->pagina/box_$this->pagina.mtl");
        $texto.= "</body><html>";
        echo $texto;

//        include_once URL . '/biblioteca/box' . $p . 'mtl';
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

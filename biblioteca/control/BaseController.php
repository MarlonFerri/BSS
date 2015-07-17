<?php
/*
 * Classe base para controls do framework
 * @author Marlon Ferri <marlonjferri@gmail.com>
 */

class BaseController {

    public $view;
    
    /*
     * Função que irá redirecionar acontecimento da página. Recebendo o primeiro valor após a URL.
     * $p será o valor a ser recebido como página;
     * $need terá dois valores possíveis: "true" para uma página normal, 
     * ou "request" quando haver request como um dos campos da url. Neste caso
     * há um dos campos na url com o valor request, indicando chamada dentro da página,
     * sem atualização da mesma
     * A partir do need, cria-se um objeto BaseView para gerar a página e/ou redireciona
     * para a função apropriada da página no modelo minhapaginaAction();
     * 
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * @param String $p
     * @param String $need
     * @return void
     */

    public function loadAction($p, $need) {
        if ($need == "true"){
            $this->view = new BaseView($p);
            $p = $p . "Action";
        }
        else if ($need == "request") 
            $p = $p . "Request"; 
        else
            $p = $p . "Action";
        $this->$p();
    }
    
    
    /*
     * Função para evitar injections nos inputs.
     * @author Marlon Ferri <marlonjferri@gmail.com>
     * @param String $str
     * @return String
     */
    public function stripAll($str){
        $str = strip_tags($str);
        $str = mysql_escape_string($str);
        $str = escapeshellcmd($str);
        
        return $str;
    }

}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoaderJS
 *
 * @author PC
 */
class LoaderJS {
    //put your code here
    function __construct($js) {
        if(file_exists("js/$js")){
            $addjs = "<script type=\"text/javascript\" src=\"" . URL . "/js/$js.js\"></script>";
        }
    }
}

?>

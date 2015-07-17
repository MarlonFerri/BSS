<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function stripLetters($string){
    $string = str_replace("á", "&aacute;", $string);
    $string = str_replace("à", "&agrave;", $string);
    $string = str_replace("ã", "&atilde;", $string);
    $string = str_replace("â", "&acirc;", $string);
    
    $string = str_replace("é", "&eacute;", $string);
    $string = str_replace("ê", "&ecirc;", $string);
    
    $string = str_replace("í", "&iacute;", $string);
    $string = str_replace("ì", "&igrave;", $string);
    
    $string = str_replace("ó", "&oacute;", $string);
    $string = str_replace("ò", "&ograve;", $string);
    $string = str_replace("ö", "&ouml;", $string);
    $string = str_replace("õ", "&otilde;", $string);
    
    $string = str_replace("ú", "&uacute;", $string);
    $string = str_replace("ü", "&uuml;", $string);
    
    $string = str_replace("ç", "&ccedil;", $string);
    
    
    $string = str_replace("Á", "&Aacute;", $string);
    $string = str_replace("À", "&Agrave;", $string);
    $string = str_replace("Ã", "&Atilde;", $string);
    $string = str_replace("Â", "&Acirc;", $string);
    
    $string = str_replace("É", "&Eacute;", $string);
    $string = str_replace("Ê", "&Ecirc;", $string);
    
    $string = str_replace("Í", "&Iacute;", $string);
    $string = str_replace("Ì", "&Igrave;", $string);
    
    $string = str_replace("Ó", "&Oacute;", $string);
    $string = str_replace("Ò", "&Ograve;", $string);
    $string = str_replace("Ö", "&Ouml;", $string);
    $string = str_replace("Õ", "&Otilde;", $string);
    
    $string = str_replace("Ú", "&Uacute;", $string);
    $string = str_replace("Ü", "&Uuml;", $string);
    
    $string = str_replace("Ç", "&Ccedil;", $string);

    return $string;
    
}
?>

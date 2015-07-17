/* 
 * Jquery para manipulação do menu que substitui o menu do botão direito do mouse
 * Impede que ele funcione e gera novo menu no local. Necessário div display: none previamente
 * colocada no html.
 * Também é necessário request para esta atividade onde será devolvido o conteúdo 
 * a ser inserido no menu
 * 
 * Author: Marlon Jean Ferri - 13/04/2013
 * Atuzlização:
 */


$(document).ready(function(){
    $(".news_content", "*").live("contextmenu",function(e){
        $("#popmenu").hide();
        $("#popmenu").css("left", e.pageX);
        $("#popmenu").css("top", e.pageY);
//        chamar procedimento de menu do item clicado e introduzir no html();
//        Usar também o procedimento de post

        $("#popmenu").html();
        $("#popmenu").show(300);
        return false;
    });
    $(document).bind("contextmenu",function(e){
        return false;
    });
    
});

$("#popmenu").live("mouseleave",function(){
    tempo = setTimeout("$('#popmenu').hide(100)", 1000);
});
$("#popmenu").live("mouseover",function(){
    clearTimeout(tempo);
});

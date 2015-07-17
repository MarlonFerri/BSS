$(function(){
    $('img').live("click", function(){
        $(this).parent("div").hide("slow");
    });
    $(function checkRules(){
        for (i=0;i<mensagens.length;i++){
            base = $(target[i]);
            x = base.offset().left;
            y = base.height() + base.offset().top;
            mens = mensagens[i];
            $(mens).css('left',x+'px');
            $(mens).css('top',y+'px');
            $(mens).css('position','absolute');
            
        }
//        nome = "#d4";
//        base = $(nome);
//        x = base.offset().left;
//        y = base.height() + base.offset().top;
        
    });



})
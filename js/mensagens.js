$(function(){
    nome = "#d5";
    base = $(nome);
    x = base.offset().left;
    y = base.height() + base.offset().top;
    $('#m1').css('left',x+'px');
    $('#m1').css('top',y+'px');
    $('#m1').css('position','absolute');
    
    nome = "#d4";
    base = $(nome);
    x = base.offset().left;
    y = base.height() + base.offset().top;
    $('#m2').css('left',x+'px');
    $('#m2').css('top',y+'px');
    $('#m2').css('position','absolute');
    
    nome = "#d2";
    base = $(nome);
    x = base.offset().left;
    y = base.height() + base.offset().top;
    $('#m3').css('left',x+'px');
    $('#m3').css('top',y+'px');
    $('#m3').css('position','absolute');
    
    $('.c_men_a').live("click", function(){
        var mensagem = $(this).name;
        var acao = $(this).attr("checked");
        
        $.post('mensagens/request/',{
                mensagem: mensagem,
                acao: acao                
            },function(data){
                $("#d1").html(data);
                $(this).parent("div").hide();
            });
    });
    
    $('img').live("click", function(){
        $(this).parent("div").hide("slow");
    });
})
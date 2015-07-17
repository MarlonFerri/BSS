$(function(){
    $('.news_content').css("display", "block");
    $(".news_content").ready(function(){
//        setInterval(function(){
//            $(".news_content").first().before("<div class=\"news_content\"> </div>");
//            
//            $(".news_content").first().load('start/6/request/lista/');
//            
//            $(".exclude").parent(".news_content").remove();
//            
//                
//                if($(".news_content").first().css("display") == "none"){
//                    $(".news_content").first().fadeIn();
//                }else{
//                    $(".news_content").first().css("display", "block");
//                }
//                
//            
//            
//        }, 30000);

        $("#col_mid").load('start/request/listar/d');
        $('.news_content').css("display", "block");
    });
})

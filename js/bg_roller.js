$(function(){
    var a = 0;
    $("body").ready(function(){
        setInterval(function(){
            a++;
            if(a == 1518){ //1518 por ser a largura da imagem de fundo
                a = 0;
            }
            $("body").css("background-position", a+"px");
//            $("body").css("background-position", "-"+a+"px 0px");
//            $("body").css("background-position", "-"+a+"px 0px");
        }, 100);
    });
});

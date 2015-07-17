$(function(){
    var painel = 1;
    var maxpainel = 1;
    var prev = 0;
    $('.bloco_1, .bloco_2').live("mouseover", function(){
        $(this).css('box-shadow','0 0 10px #409CBE');
    }
    );
    $('.bloco_1, .bloco_2').live("mouseout", function(){
        $(this).css('box-shadow','none');
    }
    );
        
    $('.bloco_1, .bloco_2').live("mouseenter", function(){
        $(this).children('.nav_img').children('.nuvem_box').fadeOut(300);
    });
    $('.bloco_1, .bloco_2').live("mouseleave", function(){
        $(this).children('.nav_img').children('.nuvem_box').fadeIn(300);
    });
    
    
    
    
    
    
    $("#nav_p1").ready(function(){
        np = 2;
        while(np != 0){
            if(document.getElementById("nav_p"+np)){
                $('#nav_p'+np).css("display","none");
                np++;
            }else{
                maxpainel = np -1;
                np=0;
            }
        }
    });
    
    $("#nav_left").live("click", function(){
        if(painel == "content"){
            atual = "box";
            painel = prev;
            
        }else{
            atual = "p"+painel;
            painel--;
        }
        
        if(painel == 0)
            painel = maxpainel;
        next = "p"+painel;
        $("#nav_"+atual).animate({
            left:'-=944'
        },400,function(){
            $("#nav_"+atual).css("display","none");
            $("#nav_"+next).css('left','944px');
            $("#nav_"+next).show();
            $("#nav_"+next).animate({
                left:'-=944'
            },400);
        });
    });
    $("#nav_right, .mosaico_link").live("click", function(){
        if(painel == "content"){
            atual = "box";
            painel = prev;
        }else{
            atual = "p"+painel;        
            painel++;
        }
        
        if(painel > maxpainel)
            painel = 1;
        next = "p"+painel;
        $("#nav_"+atual).animate({
            left:'+=944'
        },400,function(){
            $("#nav_"+atual).css("display","none");
            $("#nav_"+next).css('left','-944px');
            $("#nav_"+next).show();
            $("#nav_"+next).animate({
                left:'+=944'
            },400);
        });
    });
    
   
    $('.bloco_1, .bloco_2').live("click", function(){
        atual = painel;
        prev = painel;
        painel = "content";
        id = $(this).attr('id');
//        alert(id);
        $("#nav_p"+atual).animate({
            left:'-=944'
        },400,function(){
            $("#nav_p"+atual).css("display","none");
            
            $.post('home/box',{
                id: id                
            },function(data){
                $(".box_enter").html(data);//onde vou escrever o resultado
//            $(this).parent("div").css("background", "red");
            });
            $("#nav_box").css('left','944px');
            $("#nav_box").show();
            $("#nav_box").animate({
                left:'-=944'
            },400);
        });
    });
   
});
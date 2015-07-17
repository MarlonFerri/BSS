$(function(){
    a=0;
    $("body").ready(function(){
        if(a==0){
            a=1;
            
            h = $(this).parent("div").height();
            $(".minimizar").parent("div").children('div.box_input').hide();
            $(".minimizar").text(" + ");
            $(".minimizar").attr('class', "maximizar");
            $(".minimizar").attr('ttemp', h);
        }
    });
    
    
    $('.listas').live("blur",function(){
        mid = this.id.search("_");
        id = this.id.slice(0, mid);
        sub_from = this.id.slice(mid+1, this.id.length);
        value = this.value;
        if(id == "")
            id_c = "temp_"+sub_from;
        else
            id_c = id;
        
        //al alert("id = "+id+"           sub="+sub_from);
        $(this).attr('id', id_c);
        $.post('listas/request/blur_lista',{
            id: id,
            sub_from: sub_from,
            value: value
        },function(data){
            if(id_c == "temp_"+sub_from)
                $("#"+id_c).parent("div").html(data);//onde vou escrever o resultado
            else
                $("#resultado").html(data);//onde vou escrever o resultado
        //$(this).parent("div").css("background", "red");
        });
    });
    
    $('.del').live("click", function(){
        myvar = $(this).parent("div.box_input").children("input").attr('id')
        
        mid = myvar.search("_");
        id = myvar.slice(0,mid);
        sub_from = myvar.slice(mid+1,myvar.length);
        $.post('listas/request/click_del',{
            id: id,
            sub_from: sub_from
        },function(data){
            $("#resultado").html(data);//onde vou escrever o resultado
        });
        $(this).parent("div.box_input").remove();
    });
    
    $('.add_lista').live("click", function(){
        add = "<div class=\"box_input\">";
        add += "<input type=\"text\" class=\"listas lista\" id=\"_\" value=\"\">";
        //        add += "<a href=\"#\" class=\"del\">X</a> ";
        add += "<a href=\"#\" class=\"save_tarefa\">V</a><br>";
        add += "<span> Salve sua lista antes de adicionar tarefas para ela</span>";
        add += "</div>";
        $("#col_mid").append(add+"<hr>");
        $("#_").focus();
    });
    
    $('.add_tarefa').live("click", function(){
        sub = $(this).parent("div").children("input").attr('id');        
        sub = sub.slice(0, sub.search("_"));
        add = "<div class=\"box_input\">";
        add += "<input type=\"text\" class=\"listas\" id=\"_"+sub+"\" value=\"\">";
        //        add += "<a href=\"#\" class=\"del\">X</a> ";
        add += "<a href=\"#\" class=\"save_tarefa\">V</a><br>";
        add += "<span> Salve sua tarefa antes de adicionar sub-tarefas para ela</span>";
        add += "</div>";
        $(this).parent("div.box_input").append(add);
        $("#_"+sub).focus();
        
    });
    
    $('.select_time').live("change",function(){
        
        id_c = $(this).parent("div").children("input").attr('id');
        id = id_c.slice(0, id_c.search("_"));
        sub_from = id_c.slice(id.search("_")-1, id_c.length);
       
        ano = $(this).parent("div").children("#select_y").attr('value');
        dia = $(this).parent("div").children("#select_d").attr('value');
        mes = $(this).parent("div").children("#select_m").attr('value');
        
        hora = $(this).parent("div").children("#select_h").attr('value');
        min = $(this).parent("div").children("#select_min").attr('value');
        
        value = $(this).parent("div").children("input").attr('value');
        $.post('listas/request/select_time',{
            id: id,
            ano: ano,
            dia: dia,
            mes: mes,
            hora: hora,
            min: min,
            sub_from: sub_from,
            value: value
        },function(data){
            //                $("#"+id_c).parent("div").html(data);//onde vou escrever o resultado
            $("#"+id_c).parent("div").html(data);
        });
    });
    
    
    
    
    $('.minimizar').live("click", function(){
        h = $(this).parent("div").height();
        //        $(this).parent("div").animate({"height": 18}, "slow");
        $(this).parent("div").children('div.box_input').hide("slow");
        $(this).text(" + ");
        $(this).attr('class', "maximizar");
        $(this).attr('ttemp', h);
    });
    
    $('.maximizar').live("click", function(){
        h = $(this).attr('ttemp');
        //        $(this).parent("div").animate({"height": "auto"}, "slow");
        $(this).parent("div").children('div.box_input').show("slow");
        $(this).text(" - ");
        $(this).attr('class', "minimizar");
    });
    
    
    $('.concluir').live("click", function(){
        id = $(this).parent("div").children("input").attr('id');
        //        alert(id);
        mid = id.search("_");
        sub_from = id.slice(mid+1, id.length);
        id = id.slice(0, mid);
        
        //        alert(id);
        //        alert(sub_from);
        $id_c = $(this).parent("")
        
        target_id = $(this).parent("div").children("input").attr('id');
        target_class = $("#"+target_id).attr('class');
//        $("#"+target_id).css('background',"red");
//        alert("id="+target_id+"\nclass="+target_class);
        while(target_class != "listas lista"){
            target_id = $("#"+target_id).parent(".box_input").parent(".box_input").children("input").attr('id');
            target_class = $("#"+target_id).attr('class');
//            $("#"+target_id).css('background',"red");
//            alert("id="+target_id+"\nclass="+target_class);
            
        }
//        $("#"+target_id).parent("div").css('background',"red");
//            alert("stop");
        $.post('listas/request/concluir',{
            id: id,
            sub_from: sub_from,
            value: target_id
        },function(data){
            $("#"+target_id).parent(".box_input").html(data);
        });
        
        $("#"+id).focus();
    });
})





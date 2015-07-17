
$(function(){ // declaro o in�cio do jquery
    $('#senha_reg').hide();
    $('#senha_c_reg').hide();
    
    $('input').live("blur", function(){//bot�o para disparar a a��o
        var val_campo = this.value;
        var nome_campo = this.name;
        //        alert(nome_campo);
        if (this.value != ""){
            if(nome_campo == "senha_c_reg"){
                val_campo += "##";
                val_campo += document.getElementById('senha_reg').value;
            }
            if(nome_campo == "email_c_reg"){
                val_campo += "##";
                val_campo += document.getElementById('email_reg').value;
            }
            $.post('home/request/',{
                val_campo: val_campo,
                nome_campo: nome_campo                
            },function(data){
                retorno = nome_campo;
                if(retorno == "email_c_reg")
                    retorno = "email_reg";
                if(retorno == "senha_c_reg")
                    retorno = "senha_reg";
                $("#re_"+retorno).html(data);//onde vou escrever o resultado
            });
        }else{
            switch(this.name){
                case "nome_reg":
                    valor = "Nome Completo";
                    break;
                case "email_reg":
                    valor = "E-mail";
                    break;
                case "email_c_reg":
                    valor = "Confirme E-mail";
                    break;
                case "senha_reg":
                    //                    var oldButton = jQuery("#"+this.name);
                    //                    var newButton = oldButton.clone();
                    // 
                    //                    newButton.attr("type", "text");
                    //                    newButton.attr("id", "newInput");
                    //                    newButton.insertBefore(oldButton);
                    //                    oldButton.remove();
                    //                    newButton.attr("id", this.name);
                    //                    newButton.attr("value", 'Senha');
                    $('#senha_reg').hide();
                    $('#senha_reg_temp').show();
//                    $('#senha_reg').focus();
                    break;
                case "senha_c_reg":
                    //                    var oldButton = jQuery("#"+this.name);
                    //                    var newButton = oldButton.clone();
                    // 
                    //                    newButton.attr("type", "text");
                    //                    newButton.attr("id", "newInput");
                    //                    newButton.insertBefore(oldButton);
                    //                    oldButton.remove();
                    //                    newButton.attr("id", this.name);
                    //                    newButton.attr("value", 'Confirme Senha');
                    $('#senha_c_reg').hide();
                    $('#senha_c_reg_temp').show();
                    break;
                
            }
            $(this).attr('value',valor)
        }
        
    });
    
    $('input').live("focus" ,function(){
        //        alert(this.value);
        
        switch(this.value){
            case "Nome Completo":
                $(this).attr('value','');
                break;
            case "E-mail":
                $(this).attr('value','');
                break;
            case "Confirme E-mail":
                $(this).attr('value','');
                break;
            case "Senha":
                $('#senha_reg_temp').hide();
                $('#senha_reg_temp').attr('value','Senha');
                $('#senha_reg').show();
                $('#senha_reg').focus();
                $('#senha_reg').attr('value','');
                break;
            case "Confirme Senha":
                $('#senha_c_reg_temp').hide();
                $('#senha_c_reg_temp').attr('value','Confirme Senha');
                $('#senha_c_reg').show();
                $('#senha_c_reg').focus();
                $('#senha_c_reg').attr('value','');
                break;
        }
    });
    
})
var check_ok_antiga="aff";
$(function() {
    $('input').mousemove(function () {
        //alert("apertei");
        var nome_ok = document.getElementById('nome_hidden').value;
        var login1_ok = document.getElementById('login1_hidden').value;
        var login2_ok = document.getElementById('login2_hidden').value;
        var senha1_ok = document.getElementById('senha1_hidden').value;
        var senha2_ok = document.getElementById('senha2_hidden').value;
        var check_ok = document.getElementById('check_reg').checked;
        
        if(nome_ok =="ok" && login1_ok =="ok" && login2_ok =="ok" && senha1_ok =="ok" && senha2_ok =="ok" && check_ok){
            $('#b_registrar').removeAttr('disabled');
            $('#b_registrar').attr('class',"botao");
        }
        
        
    });
})

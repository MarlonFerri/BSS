$(function(){
    $('#senha').hide();
    $('#senha_temp').live("focus",function(){
        var name = this.value;
        $('#senha_temp').hide();
        $('#senha').show();
        $('#senha').focus();
    });
    $('#senha').live("blur", function(){
        if( this.value == ""){
            $('#senha').hide();
            $('#senha_temp').show();
        }
    });
    $('#login').live("focus",function(){
        if(this.value == "e-mail")
        $('#login').attr('value','')
    });
    $('#login').live("blur",function(){
        if(this.value == "")
        $('#login').attr('value','e-mail')
    });
});
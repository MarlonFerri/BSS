/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(function retorno(){
    $('#ok').click(function(){
        var email = document.getElementById('email').value;
        $.post('home/request/',{
                email : email                
            },function(data){
                $('#retorno').html(data);//onde vou escrever o resultado
                
            });
            return false;
    });
    
})
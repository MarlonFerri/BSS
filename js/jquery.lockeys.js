/*!
 * jQuery lockKeys 1.0
 *
 * Copyright 2010, Magno Bi�t
 *
 */
 
$(document).ready(function(){
	$(document).bind("contextmenu",function(e){
		return false;
	});
});
$(document).keydown(function(event){ 
	if(event.keyCode==67 && event.ctrlKey){ 
		return false;
	}
});
$(document).keydown(function(event){ 
	if(event.keyCode==123){ 
		//alert('Por raz�es de seguran�a n�o pode ser executada tecla a F12 nesta p�gina.');
		return false;
	}
});
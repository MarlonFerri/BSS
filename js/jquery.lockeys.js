/*!
 * jQuery lockKeys 1.0
 *
 * Copyright 2010, Magno Biét
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
		//alert('Por razões de segurança não pode ser executada tecla a F12 nesta página.');
		return false;
	}
});
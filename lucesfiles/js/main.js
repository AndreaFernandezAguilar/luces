function caracteres(e) 
{
    tecla = (document.all) ? e.keyCode : e.which;
 	if (tecla==8 || tecla==37 || tecla<=38 || tecla==39 || tecla<=40) return true;
    patron =/[A-Z a-z ñáéíóú ÑÁÉÍÓÚ ']/;
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

//var expRegFecha = /^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9|1[012]])[\-](19|20)\d{2}$/;
var expRegFecha = /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/;
function fecha(e)
{
	if(!expRegFecha.exec(document.getElementById('birthday').value))
	{
		alert('Debe ingresar un formato correcto de entrada');
	}
}

function enteros(objeto, e)
{
	var keynum,
	keychar,
	numcheck

	if(window.event)
	{ /*/ IE*/
		keynum = e.keyCode
	}

	else if(e.which)
	{ /*/ Netscape/Firefox/Opera/*/
		keynum = e.which
	}

	if((keynum >= 35 && keynum <= 37) || keynum ==8 || keynum == 9 || keynum == 46 || keynum == 39) 
	{
		return true;
	}

	if((keynum >= 95 && keynum <= 105) || (keynum >= 48 && keynum <= 57))
	{
		return true;
	}

	else 
	{
		return false;
	}
}

$(document).ready(function()
{ 
    $('.SlectBox').SumoSelect();
    $('.datepicker').datepicker(
    {
		format: 'yyyy-mm-dd'
	});
});
$(document).ready(function()
{$('#patient_name').blur(function(evento)
{	
	if ($('input[name=patient_name]').val().length < 2) 
 	{
 		alert("El nombre del Paciente no debe ser menor de 2 caracteres");
 		//$('#patient_name').focus();
 	}

 	else
 	{				
 		$('#name-span').html($('input[name=patient_name]').val());
 	}
});

$('#patient_lastname').blur(function(evento)
{
	if ($('input[name=patient_lastname]').val().length < 3) 
	{
	 	alert("El apellido del Paciente no debe ser menor de 3 caracteres");
	}

	else
 	{				
 		$('#lastName-span').html($('input[name=patient_lastname]').val());
 	}
});

$('#idcard').blur(function(evento)
{
	if ($('input[name=idcard]').val().length < 7) 
	{
		alert("El numero de cédula ingresado NO puede ser menor de 7 digitos");
	}

	else if ($('input[name=idcard]').val().length > 10) 
	{
		alert("El número de cédula ingresado NO puede ser mayor de 10 dígitos");
	}

	else
 	{				
 		$('#id-span').html($('#idcard').val());
 	}
});

/*$('#mobile_code').blur(function(evento)
{
	if ($('input[name=mobile_code]').val().length != 4 ) 
	{
		alert("El código del télefono móvil debe ser de 4 digitos");
	}
});*/

$('#mobile_number').blur(function(evento)
{
	if ($('input[name=mobile_number]').val().length != 7 ) 
	{
		alert("El número del télefono móvil debe ser de 7 digitos");
	}
});

$('#phone_code').blur(function(evento)
{
	if ($('input[name=phone_code]').val().length != 4 ) 
	{
		alert("El código del télefono local debe ser de 4 digitos");
	}
});

$('#phone_number').blur(function(evento)
{
	if ($('input[name=phone_number]').val().length != 7 ) 
	{
		alert("El número del télefono local debe ser de 7 digitos");
	}
});

$("#state-select-box").change(function(e)
{	
 	var state= $("#state-select-box").val();
     			 
 	//AJAX
	$.ajax(
 	{
    	url: "../modules/controllers/state-controller.php",
    	type:"post",
    	data:
    	{					
           "state":state
    	},

        success: function(oper)
        {
            $("#cities").html(oper);
            $('.SlectBox').SumoSelect();
        },

        error: function(error)
        {
           	alert(error);
        }
	}); //end ajax
});//end function change


    $("#form-medical-history").submit(function(e)
	{
		e.preventDefault();
		//var check = $("input[type='checkbox']:checked").length;

		if ($('input[name=patient_name]').val().length < 3) 
		{
	 		alert("El nombre del Paciente no debe ser menor de 3 caracteres");
	 		return false;
	 		//$('#patient_name').focus();
	 	}
			
		if ($('input[name=patient_lastname]').val().length < 3) 
		{
		 	alert("El apellido del Paciente no debe ser menor de 3 caracteres");
		 	return false;
		}	

		if ($ ('input[name=patient_name]').val() === '') 
		{
			alert ('No se ha suministrado el Nombre del Paciente');
			e.preventDefault ();
			return false;
		}

		if ($ ('input[name=patient_lastname]').val() === '') 
		{
			alert ('No se ha suministrado el Apellido del Paciente');
			e.preventDefault ();
			return false;
		}	

		if($('select[name=patient_gender]').val() === '')
		{
			alert("Debe seleccionar el Género");
			e.preventDefault();
			return false;
		}

		if($('input[name=birthday]').val() === '')
		{
			alert("No se ha suministrado la fecha de Nacimiento del Paciente");
			e.preventDefault();
			return false();
		}

		if ($ ('input[name=idcard]').val () === '') 
		{
			alert ('No se ha suministrado la Cédula del Paciente');
			e.preventDefault ();
			return false;
		}

		if ($('input[name=idcard]').val().length < 7 || $('input[name=idcard]').val().length > 10) 
		{
			alert("El numero de cédula ingresado NO puede ser menor de 7 digitos ni mayor a 10");
			//e.preventDefault;
			return false;
		}

		if ($('select[name=maritalStatus]').val()=== '0') 
		{
			alert('Debe seleccionar su Estado Civil');
			e.preventDefault;
			return false;
		}

		if ($('input[name=ocupation]').val().trim() === '') 
		{
			alert('Dede Ingresar su Profesión');
			e.preventDefault();
			return false;
		}

		if ($('textarea[name=address]').val().trim() === '')
		{
			alert('No se ha suministrado la Dirección del Paciente');
			e.preventDefault();
			return false;				
		}

		if ($('select[name=state]').val() ==='0')
		{
			alert('Seleccione el estado de residencia actual');
			e.preventDefault();
			return false;
		}	

		if ($('select[name=city]').val() ==='0')
		{
			alert('Seleccione la ciudad de residencia actual');
			e.preventDefault();
			return false;
		} 

		if  ($('select[name=mobile_code]').val() === '0' && $('input[name=phone_code]').val() === '')
		{
			alert("Debe Ingresar al menos un número de Contacto");
			e.preventDefault();
			return false;
		}

		if  ($('#mobile_code').val()!="0412" && $('#mobile_code').val()!="0414" && $('#mobile_code').val()!="0416" && $('#mobile_code').val()!="0424" && $('#mobile_code').val()!="0426" && $('input[name=mobile_code]').val()!="")
		{
			alert("El código del telf. móvil no es válido. Por favor verifique.");
			e.preventDefault();
			return false;
		}

		if  ($('input[name=mobile_number]').val() === '' && $('input[name=phone_number]').val() === '')
		{
			alert("Debe Ingresar al menos un número de Contacto");
			e.preventDefault();
			return false;
		}

		if ($('input[name=mobile_code]').val() =='' && $('input[name=mobile_number]').val() !='') 
		{
			alert("Debe ingresar el código del télefono móvil");
			e.preventDefault();
			return false;
		} 

		if ($('input[name=phone_code]').val() === '' && $('input[name=phone_number]').val() !='') 
		{
			alert("Debe ingresar el código del télefono local");
			e.preventDefault();
			return false;
		} 

		if ($('#mobile_code').val() !="" && $('#mobile_number').val() ==='') 
		{
			alert("Debe ingresar el numero del télefono móvil completo");
			e.preventDefault();
			return false;
		} 

		if ($('input[name=phone_code]').val() !='' && $('input[name=phone_number]').val() ==='') 
		{
			alert("Debe ingresar el número del télefono local completo");
			e.preventDefault();
			return false;
		} 


		/*if ($('input[name=mobile_code]').val() == 0 ) 
		{
			 alert("El código del télefono móvil debe ser de 4 digitos");
			 return false;
}*/

		if ($('input[name=mobile_number]').val().length != 7 && $('input[name=mobile_number]').val()!="") 
		{
			alert("El número del télefono móvil debe ser de 7 digitos");
			return false;
		}

		if ($('input[name=phone_code]').val().length != 4 && $('input[name=phone_code]').val()!="") 
		{
			alert("El código del télefono local debe ser de 4 digitos");
			return false;
		}

		if ($('input[name=phone_number]').val().length != 7 && $('input[name=phone_number]').val()!="") 
		{
			alert("El número del télefono local debe ser de 7 digitos");
			return false;
		}


		if ($('input[name=email]').val() === '') 
		{
			alert("No se ha suministrado el correo Electrónico");
			e.preventDefault();
			return false;
		};

		if(! $('#legal-text').prop('checked'))
		{
			alert("Debe Aceptar Términos y Condiciones Antes de Continuar");
			return false;
		}

		/*end validaciones*/
		var idcard = $("#idcard").val();
		var patient_name=$("#patient_name").val();
		var patient_lastname=$("#patient_lastname").val();
		var patient_gender=$("#gender-select-box").val();
		var birthday=$("#birthday").val();
		var maritalStatus=$("#status-select-box").val();
		var ocupation=$("#ocupation").val();
		var address=$("#address").val();
		var state=$("#state-select-box").val();
		var city=$("#city-select-box").val();
		var mobile_code=$("#mobile_code").val();
		var mobile_number=$("#mobile_number").val();
		var phone_code =$("#phone_code").val();
		var phone_number=$("#phone_number").val();
		var email=$("#email").val();
		var referedBy=$("#referedBy").val();
		var lastPeriod=$("#lastPeriod").val();
		var numberOfPregnancys=$("#numberOfPregnancys").val();
		var allergies=$("#allergies").val();
		var medical_history= $("input[name='medical_history\\[\\]']:checked")
      	.map(function(){return $(this).val();}).get();

		//AJAX
		$.ajax(
		{
			url: "../modules/controllers/patient-controller.php",
			type:"post",
			data:
			{	
                "idcard":idcard,
                "patient_name":patient_name,
                "patient_lastname":patient_lastname,
                "patient_gender":patient_gender,
                "birthday":birthday,
                "maritalStatus":maritalStatus,
                "ocupation":ocupation,
                "address":address,
                "state":state,
                "city":city,
                "mobile_code":mobile_code,
				"mobile_number":mobile_number,
				"phone_code":phone_code,
				"phone_number":phone_number,
				"email":email,
				"referedBy":referedBy,
				"medical_history":medical_history,
				"lastPeriod":lastPeriod,
				"numberOfPregnancys":numberOfPregnancys,
				"allergies":allergies
			},

        	success: function(oper)
        	{
        	   $("#medicalHistory").empty();
       		   $("#medicalHistory2").empty();
       		   $("#medicalHistory").html(oper);
       		   $("#medicalHistory2").html(oper);
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}
	    }); //end ajax

	}); // end function 
}); //End

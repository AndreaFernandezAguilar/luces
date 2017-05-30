
	var expRegFecha = /^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9|1[012]])[\-](19|20)\d{2}$/;

	function caracteres(e) 
	{
    	tecla = (document.all) ? e.keyCode : e.which;
 		if (tecla==8 || tecla==37 || tecla<=38 || tecla==39 || tecla<=40) return true;
    	patron =/[A-Za-z]/;
    	te = String.fromCharCode(tecla);
    	return patron.test(te);
	}

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
    $("#form-show-history").submit(function(e)
	{
			e.preventDefault();
			var identityCard = $("#identityCard").val();

			//AJAX - Form-Show-History
    		$.ajax(
    		{
    			url: "../modules/controllers/modify_medical_history-controller.php",
    			type:"post",
    			data:
    			{	
    						
                    "identityCard":identityCard
    			},

                success: function(oper)
                {
                   	$("#medicalHistory").html(oper); 		 
	                $("#medicalHistoryChanged").empty();
	                $("#medicalHistoryChanged2").empty();

					$('.SlectBox').SumoSelect();

				     	$("#state-select-box").change(function(e)
				     	{	
				     		var state= $("#state-select-box").val();	 
				     		//AJAX State-City
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
						    }); //End Ajax State-City
				     	}); // End   state-select-box

				     	$('#patient_name').blur(function(evento)
 						{
 							if ($('input[name=patient_name]').val().length < 3) 
			 				{
			 					alert("El nombre del Paciente no debe ser menor de 3 caracteres");
			 					//$('#patient_name').focus();
			 				}

 						});

				 		$('#patient_lastname').blur(function(evento)
				 		{
				 			if ($('input[name=patient_lastname]').val().length < 3) 
				 				{
				 					alert("El appelido del Paciente no debe ser menor de 3 caracteres");
				 				}
				 		});

				 		$('#idcard').blur(function(evento)
						 {
						 	if ($('input[name=idcard]').val().length < 7) 
						 		{
						 			alert("El numero de cédula ingresado NO puede ser menor de 7 digitos");
						 		}

						 	if ($('input[name=idcard]').val().length > 10) 
						 		{
						 			alert("El número de cédula ingresado NO puede ser mayor de 10 dígitos");
						 		}
						 });

				 		$('#mobile_code').blur(function(evento)
						 {
						 	if ($('input[name=mobile_code]').val().length != 4 ) 
						 		{
						 			alert("El código del télefono móvil debe ser de 4 digitos");
						 		}
						 });

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

						$("#form-medical-history").submit(function(e)
						{
							e.preventDefault();

							if ($('input[name=patient_name]').val().length < 3) 
				 			{
				 				alert("El nombre del Paciente no debe ser menor de 3 caracteres");
				 				$('#patient_name').focus();
				 				return false;			
				 			}
							
							if ($('input[name=patient_lastname]').val().length < 3) 
				 				{
				 					alert("El appelido del Paciente no debe ser menor de 3 caracteres");
				 					return false;
				 				}	

						  		if ($ ('input[name=patient_name]').val() === '') 
							{
								alert ('No se ha suministrado el Nombre del Paciente');
								evento.preventDefault ();
								return false;
							}

							if ($ ('input[name=patient_lastname]').val() === '') 
							{
								alert ('No se ha suministrado el Apellido del Paciente');
								evento.preventDefault ();
								return false;
							}

							if($('select[name=patient_gender]').val() === '')
							{
								alert("Debe seleccionar el Género");
								evento.preventDefault();
								return false;
							}

							if($('input[name=birthday]').val() === '')
							{
								alert("No se ha suministrado la fecha de Nacimiento del Paciente");
								evento.preventDefault();
								return false();
							}

							if ($ ('input[name=idcard]').val () === '') 
							{
								alert ('No se ha suministrado la Cédula del Paciente');
								evento.preventDefault ();
								return false;
							}

							if ($('input[name=idcard]').val().length < 7 || $('input[name=idcard]').val().length > 10) 
						 		{
						 			alert("El numero de cédula ingresado NO puede ser menor de 7 digitos ni mayor a 10");
						 			//evento.preventDefault;
									return false;
						 		}


							if ($('select[name=maritalStatus]').val()=== '0') 
							{
								alert('Debe seleccionar su Estado Civil');
								evento.preventDefault;
								return false;
							}

							if ($('input[name=ocupation]').val().trim() === '') 
							{
								alert('Dede Ingresar su Profesión');
								evento.preventDefault();
								return false;
							}

							if ($('textarea[name=address]').val().trim() === '')
							{
								alert('No se ha suministrado la Dirección del Paciente');
								evento.preventDefault();
								return false;				
							}

							if ($('select[name=state]').val() ==='0')
							{
								alert('Seleccione el estado de residencia actual');
								evento.preventDefault();
								return false;
							}


							if ($('select[name=city]').val() ==='0')
							{
								alert('Seleccione la ciudad de residencia actual');
								evento.preventDefault();
								return false;
							} 


							if  ($('input[name=mobile_code]').val() === '' && $('input[name=phone_code]').val() === '')
							{
								alert("Debe Ingresar al menos un número de Contacto");
								evento.preventDefault();
								return false;
							}

							if  ($('input[name=mobile_number]').val() === '' && $('input[name=phone_number]').val() === '')
							{
								alert("Debe Ingresar al menos un número de Contacto");
								evento.preventDefault();
								return false;
							}


							if ($('input[name=mobile_code]').val() === '' && $('input[name=mobile_number]').val() !='') 
							{
								alert("Debe ingresar el código del télefono móvil");
								evento.preventDefault();
								return false;
							} 



							if ($('input[name=phone_code]').val() === '' && $('input[name=phone_number]').val() !='') 
							{
								alert("Debe ingresar el código del télefono local");
								evento.preventDefault();
								return false;
							} 



							if ($('input[name=mobile_code]').val() !='' && $('input[name=mobile_number]').val() ==='') 
							{
								alert("Debe ingresar el numero del télefono móvil completo");
								evento.preventDefault();
								return false;
							} 



							if ($('input[name=phone_code]').val() !='' && $('input[name=phone_number]').val() ==='') 
							{
								alert("Debe ingresar el número del télefono local completo");
								evento.preventDefault();
								return false;
							} 

							if  ($('#mobile_code').val()!="0412" && $('#mobile_code').val()!="0414" && $('#mobile_code').val()!="0416" && $('#mobile_code').val()!="0424" && $('#mobile_code').val()!="0426")
								{
									alert("El código del telf. móvil no es válido. Por favor verifique.");
									e.preventDefault();
									return false;
								}

							if ($('input[name=mobile_number]').val().length != 7 ) 
								{
									alert("El número del télefono móvil debe ser de 7 digitos");
									return false;
								}
								if ($('input[name=phone_code]').val().length != 4 ) 
									{
									 	alert("El código del télefono local debe ser de 4 digitos");
									 	return false;
									}

							if ($('input[name=phone_number]').val().length != 7 ) 
								{
									alert("El número del télefono local debe ser de 7 digitos");
									return false;
								}




							if ($('input[name=email]').val() === '') 
							{
								alert("No se ha suministrado el correo Electrónico");
								evento.preventDefault();
								return false;
							};
							
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

							//AJAX - form-medical-history
						    $.ajax(
						    {
						    	url: "../modules/controllers/patient-modify-controller.php",
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
						            $("#medicalHistoryChanged").html(oper);
						            $("#medicalHistoryChanged2").html(oper);                 		      
						        },

						        error: function(error)
						        {
						            alert(error);
						        }
							}); //End AJAX form-medical-history    			
						});    		  
                    },
                    error: function(error)
                    {
                    	alert(error);
                    }
		        }); //end ajax
    		});
     	});

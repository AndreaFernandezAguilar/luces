$(document).ready(function()
{ 	
	$("#form-delete-appointment").submit(function(e)
	{
		e.preventDefault();
		if ($("#okId").length==0 )
     	{
  			//alert ('Debes ingresar una cedula de identidad válida');
  			setTimeout(function ()
			{
				swal({   title: "Error",   text: "Debes ingresar una cédula de identidad válida",   type: "error", confirmButtonClass: "btn-default" });
			},100);

			$("#identityCard").focus();
     		return false;
		}

		if ($('select[name=branch]').val() ==='0')
		{
			setTimeout(function ()
			{
				swal({   title: "Datos Incompletos",   text: "Seleccione la Sucursal",   type: "warning", confirmButtonClass: "btn-default" });
				},100);
					
				return false;
			}

		if ($('select[name=treatment-select-box]').val() ==='0')
		{
					
			setTimeout(function ()
			{
				swal({   title: "Datos Incompletos",   text: "Seleccione el Tratamiento",   type: "warning", confirmButtonClass: "btn-default" });
			},100);
					
			return false;
		}

		var identityCard = $("#identityCard").val();	
		var branch=$("#branch-select-box").val();
     	var treatment= $("#treatment-select-box").val();
     	var appointmentDate=$("#appointmentDate").val();
     			
		//AJAX delete appointment
		$.ajax(
		{
			url: "../modules/controllers/delete_appointment-controller.php",
			type:"post",
			data:
			{	
				"identityCard":identityCard,
				"branch":branch,
				"treatment":treatment,
				"appointmentDate":appointmentDate        
			},

			success: function(oper)
			{	  
				$("#results").html(oper);
			},

			error: function() 
			{
				//alert('Ha ocurrido un error mientras se guardaban los cambios');
				setTimeout(function ()
				{
					swal({   title: "ERROR",   text: "Ha ocurrido un error mientras se guardaban los cambios",   type: "error", confirmButtonClass: "btn-default" });
				},100);
			}
		}); //end AJAX delete appointment
	});
});
 

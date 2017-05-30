$(document).ready(function()
{	
    $('#new_password2').blur(function(e)
    {		
     	var new_password=$('#new_password').val();
     	var new_password2=$('#new_password2').val();

     	if (new_password!= new_password2) 
     	{
     		$("#change-pass").html("Las claves no coinciden.<span class='glyphicon glyphicon-remove' style='color:red;'></span>");
     		$("#result-change-password").empty();

     	}

     	else
     	{	
     		$("#change-pass").empty();	
     		$("#result-change-password").empty();
     	}			
    });

    $("#form-password").submit(function(e)
	{
		e.preventDefault();
		var password = $("#password").val();
		var new_password = $("#new_password").val();
		var new_password2 = $("#new_password2").val();

		if (new_password!= new_password2) 
     	{
            setTimeout(function ()
            {
                swal({   title: "ERROR",   text: "Las claves no coinciden. Por favor verifique",   type: "error", confirmButtonClass: "btn-default" });
            },100);
     		return false;
     	}

		else
		{
			//AJAX
    		$.ajax(
    		{
    			url: "../modules/controllers/change_password-controller.php",
    			type:"post",
    			data:
    			{	
                    "password":password,
                    "new_password":new_password,
    			},

                success: function(data)
                {
                   	$("#result-change-password").html(data);		  
                },

                error: function(error)
                {
                    setTimeout(function ()
                    {
                        swal({   title: "ERROR",   text: "Ha ocurrido un error al cambiar la clave",   type: "error", confirmButtonClass: "btn-default" });
                    },100);
                }
		   }); //end ajax
    	}			
	});
});

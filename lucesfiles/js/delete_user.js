$(document).on("click",".delete-user",function()	
{		
	var idUser=$(this).attr("id");  		
	$(".modal-title").html("Eliminar Usuario del Sistema");
	$(".modal-body").html("<h4 class='text-center'>¿Estás seguro(a) que desea eliminar este usuario?</h4>");
	$(".modal-button-confirm").attr("id",idUser);
	$('#genericModal').modal();

	$(".modal-button-confirm").click(function(e)
	{	
		e.preventDefault;		
		$("#genericModal").modal("hide");
		//AJAX - Delete Treatment from Sale
		$.ajax(
	    {	

	    	url: "../modules/controllers/delete_user-controller.php",
	    	type:"post",
	    	data:
	    	{	
	    		"idUser":idUser           	
	    	},

	        success: function(data)
	        {       
	            var r=parseInt(data);
	            if(r==1)
	            {
	                setTimeout(function ()
			        {
			            swal({   title: "Usuario eliminado",   text: "Se ha eliminado el usuario del sistema",   type: "success", confirmButtonClass: "btn-default" });
			        },100);

			        $("#tr_"+idUser).remove();
	            }

	           	else if(r==0)
	            {
	                setTimeout(function ()
			        {
			            swal({   title: "ERROR",   text: "Ha ocurrido un error al intentar eliminar el usuario",   type: "error", confirmButtonClass: "btn-default" });
			            },100);
	            }	                    	
			},

			error: function(error)
	        {   	
	            setTimeout(function ()
				{
					swal({   title: "ERROR",   text: "Se ha producido un error:"+error,   type: "error", confirmButtonClass: "btn-default" });
				},100);	
	        }
		}); //end AJAX Delete Treatment from Sale					
	});
});
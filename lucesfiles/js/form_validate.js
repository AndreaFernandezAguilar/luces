$(document).on('blur','input[name=identityCard]', function () 
{
	if ($("#identityCard").val()!='')
	{	
		var identityCard=$("#identityCard").val();
		     			
		//AJAX - Validate IdentityCard
		$.ajax(
		{
		    url:"../modules/controllers/validate_identityCard-controller.php",
		   	type:"post",
		    data:
		    {
		     	"identityCard":identityCard
		    },

		    success: function(data)
		    {
		     	$("#validate-identityCard").html(data);				
		    },

		    error: function (error)
		    {
			    setTimeout(function ()
				{
					swal({   title: "ERROR",   text: "Ha ocurrido un error",   type: "error", confirmButtonClass: "btn-default" });
				},100);	
		    }
		}); //End AJAX Validate IdentityCard
	}		    
});

$(document).ready(function()
{
	$('.SlectBox').SumoSelect();
    function validate_form()
    {

    }
});
     
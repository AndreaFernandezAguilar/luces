 $(document).ready(function()
{   
  $("#form-show-history").submit(function(e)
	{
		e.preventDefault();
		var identityCard = $("#identityCard").val();
		var oper="delete";

    	//AJAX
        $.ajax(
        {
        	url: "../modules/controllers/show_medical_history-controller.php",
        	type:"post",
        	data:
        	{	
              "identityCard":identityCard,
              "oper":oper
        	},

          success: function(oper)
          {
            $("#medicalHistory").html(oper);
            $("#medicalHistory3").empty();
            $("#medicalHistory4").empty();
            $(':checkbox').click(function()
            {
    			return false;        
    		});

			$("#form-medical-history").submit(function(e)
		  	{
				e.preventDefault();
				var identityCard = $("#identityCard").val();
				var oper="delete";

				//AJAX
    			$.ajax(
    			{
    				url: "../modules/controllers/delete-patient-medical_history-controller.php",
    				type:"post",
    				data:
    				{	
                        "identityCard":identityCard,
                        "oper":oper
    				},

                    success: function(oper)
                    {
                   		$("#medicalHistory").empty();
                   		$("#medicalHistory").html(oper);
                        
                        /*Readonly all checkbox*/
                   		$(':checkbox').click(function()
                   		{
							return false;        
						});
                    },

                    error: function(error)
                    {
                    	setTimeout(function ()
                        {
                            swal({   title: "ERROR",   text: "Ha ocurrido un error",   type: "error", confirmButtonClass: "btn-default" });
                        },100); 
                    }
                }); //end ajax	
			});       		  
        },

        error: function(error)
        {
            setTimeout(function ()
            {
                swal({   title: "ERROR",   text: "Ha ocurrido un error",   type: "error", confirmButtonClass: "btn-default" });
                },100); 
            }
		}); //end ajax			
	}); 
});
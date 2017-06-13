$(document).ready(function()
{
    $("#form-show-history").submit(function(e)
    {
      	e.preventDefault();
      	var identityCard = $("#identityCard").val();
      	var oper="view";
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
               $(':checkbox').click(function()
     		   {
                    return false;
                });  
          	},

          	error: function(error)
          	{
          	   alert(error);
          	}

      }); //end ajax	
    });
});

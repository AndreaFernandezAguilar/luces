$(document).ready(function()
{
	$('#username').blur(function(evento)
    {
		var username=$("#username").val();
		//AJAX
    	$.ajax(
    	{
			url: "../modules/controllers/user-username-controller.php",
			type:"post",
			data:
			{	
				"username":username
			},

        	success: function(data)
        	{	  
       		   $("#validateUsername").html(data);  
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}
        }); //end ajax
    });

	$("#form-new-user").submit(function(e)
  	{
  		e.preventDefault();
  		if ($('select[name=branch]').val() ==='0')
		{
			alert('Seleccione la Sucursal');
			return false;	
		}

		if ($('select[name=role]').val() ==='0')
		{
			alert('Seleccione el Rol del Usuario');
			return false;
		}

  		var identityCard = $("#identityCard").val();
		var name=$("#name").val();
		var lastname=$("#lastname").val();
		var email=$("#email").val();
		var username=$("#username").val();
		var password=$("#password").val();
		var role=$("#roles-select-box").val();
		var branch=$("#branch-select-box").val();

		//AJAX
		$.ajax(
		{
			url: "../modules/controllers/user-controller.php",
			type:"post",
			data:
			{	
				
                "identityCard":identityCard,
                "name":name,
                "lastname":lastname,
				"email":email,
				"username":username,
				"password":password,
				"role":role,
				"branch":branch
			},

        	success: function(data)
        	{	  
       		   $("#newUser").html(data);     
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}
        }); //end ajax
	});	
 });
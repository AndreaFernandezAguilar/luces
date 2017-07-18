$(document).ready(function()
{	
	console.log(78);
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

	$("#form-edit-user").submit(function(e)
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


  		var idUser=$("#idUser").val();
  		console.log("user:"+idUser);
		var name=$("#name").val();
		var lastname=$("#lastname").val();
		var email=$("#email").val();
		var username=$("#username").val();
		var password=$("#password").val();
		var role=$("#roles-select-box").val();
		var branch=$("#branch-select-box").val();
		//var idUser= getUrlParamether("idUser");
		//console.log("a:"+idUser);

		//AJAX
		$.ajax(
		{
			url: "../modules/controllers/edit_user-controller.php",
			type:"post",
			data:
			{	
				
				"idUser":idUser,
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
       		   $("#editUser").html(data);     
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}
        }); //end ajax
	});	
 });
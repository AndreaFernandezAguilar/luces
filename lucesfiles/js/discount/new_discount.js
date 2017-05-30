function caracteres(e) 
{
    tecla = (document.all) ? e.keyCode : e.which;

 	if (tecla==8 || tecla==37 || tecla<=38 || tecla==39 || tecla<=40) return true;
    	patron =/[A-Za-z]/;
    	te = String.fromCharCode(tecla);

    	return patron.test(te);
	}

$(document).ready(function()
{
    $('.SlectBox').SumoSelect();
    $('#username').blur(function(evento){

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

        success: function(oper)
        {	  
            $("#validateUsername").html(oper);           		   
        },

        error: function(error)
        {
            alert(error);
        }
	}); //end ajax

});
     
$("#form-new-discount").submit(function(e)
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

        success: function(oper)
        {	  
            $("#newUser").html(oper);            		   
        },

        error: function(error)
        {
        alert(error);
        }

	}); //end ajax
});	
});
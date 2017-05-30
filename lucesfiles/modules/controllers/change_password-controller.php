<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/user.class.php");
$user= new User();


// Validate Fields

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}

	if ($password=="" || $new_password=="") 
	{
		echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>Se han enviado algunos campos requeridos en blanco.<br>Por favor verifique.</h4>
		 	    </div>
		      </div>';
	}


	else
	{	
		$user=new User();
		session_start();

		if ($_SESSION['password']!=md5($password)) 
		{
			echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>La clave actual es incorrecta.<br>Por favor verifique.</h4>
		 	    </div>
		      </div>';
		}

		elseif ($user->changePassword($_SESSION['id_user'],$new_password)) 
		{
			echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>Clave Modificada<br> 
				Exitosamente.</h4></div></div>';
				$_SESSION['password']=md5($new_password);
		}
	}
?>
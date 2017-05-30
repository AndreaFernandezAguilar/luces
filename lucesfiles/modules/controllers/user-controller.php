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

	if ($name=="" || $lastname=="" || $identityCard=="" || $email=="" || $username=="" || $password=="" || $role==0 || $branch==0) 
	{
		echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>Se han enviado algunos campos requeridos en blanco.<br>Por favor verifique.</h4>
		 	    </div>
		      </div>';
	}


	elseif ($user->verifyIdentityCard ($identityCard)) 
	{
		echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>Ya existe un usuario registrado con esta cédula de identidad<br>Por favor verifique.</h4>
		 	    </div>
		      </div>';
	}


	elseif ($user->validateUsername($username)) 
	{
		echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>El nombre de usuario ya existe<br>Por favor elija otro.</h4>
		 	    </div>
		      </div>';
	}





	else
	{

		
		if($user->addUser($name,$lastname,$identityCard,$email,$username,$password,$role,$branch))
		{
			echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>Usuario Registrado<br> 
				Exitosamente.</h4></div></div>';
		}

		else
		{
			echo "ERRROR";
		}


	}


 ?>
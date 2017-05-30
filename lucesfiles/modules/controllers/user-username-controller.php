<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/user.class.php");


$username=$_REQUEST['username'];


$user= new User;
if ($user->validateUsername($username)) 
{
	echo "El nombre de usuario ya existe <span class='glyphicon glyphicon-remove' style='color:red;'></span>";
}

elseif(strlen($username)<5)
{
	echo "Nombre de usuario inválido  <span class='glyphicon glyphicon-remove' style='color:red;'></span>";
}

else
{
	echo "Nombre de usuario válido <span class='glyphicon glyphicon-ok' style='color:green;'></span>";
}


 ?>
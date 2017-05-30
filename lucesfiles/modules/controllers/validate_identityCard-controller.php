<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/history.class.php");


	$patient= new History();

	
	if($patient->getIdPatient($_REQUEST['identityCard']))
	{
		echo "Paciente verificado <span id='okId' class='glyphicon glyphicon-ok' style='color:green;'></span>";
		return 1;
	}

	else
	{
		echo "Paciente no registrado. Vérifique <span class='glyphicon glyphicon-remove' style='color:red;'></span>";
		return 0;
	}


 ?>
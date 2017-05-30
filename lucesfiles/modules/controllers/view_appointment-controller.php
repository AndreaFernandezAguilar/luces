<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
//require_once ("../class/treatment.class.php");
require_once ("../class/history.class.php");
require_once ("../class/appointment.class.php");

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}

	$appoint= new Appointment();

	if ($type==1)
	{
		$patient= new History();
		$idPatient=$patient->getIdPatient($identityCard);
		echo json_encode($appoint->getAppointments_ByTreatment_Patient($idPatient,$treatment,$branch));
	}

    elseif ($type==2) 
    {
    	echo json_encode($appoint->getAppointments_ByTreatment_Branch($treatment,$branch));
    }
	
	/*echo "el id del paciente es:".$idPatient;
	echo "el tratamiento es:".$treatment;
	echo "la sucursal:".$branch;*/
	
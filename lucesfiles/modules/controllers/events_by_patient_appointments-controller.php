<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
//require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");
require_once ("../class/history.class.php");



	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}


	//$treat= new Treatment();
	$appoint= new Appointment();
	$patient= new History();
	

	
	$idPatient=$patient->getIdPatient($identityCard);
	
	//echo json_encode($appoint->getAppointments_ByTreatment_Machine($machine));
	echo json_encode($appoint->getAppointments_By_Patient($idPatient,$treatment,$branch));



?>
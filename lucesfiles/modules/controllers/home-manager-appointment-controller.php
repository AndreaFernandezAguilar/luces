<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");
require_once ("../class/history.class.php");



	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}


	$treat= new Treatment();
	$appoint= new Appointment();
	$patient= new History();
	

	
	echo json_encode($appoint->getAppointments_weekly($startW,$endW));
	//echo json_encode($appoint->getAppointments_By_Patient($idPatient,$treatment,$branch));


?>
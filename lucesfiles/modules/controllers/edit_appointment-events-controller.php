<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}


	$treat= new Treatment();
	$appoint= new Appointment();


	$machine=$treat->getMachine($treatment);
	$treatments_bodyarea= $treat->getTreatments_BodyArea_ByMachine($machine);
	$events_appointments=$appoint->getAppointments_ByTreatment_Machine($machine);
	
	echo json_encode($appoint->getAppointments_ByTreatment_Machine_2($machine,$idAppointment,$branch));

?>
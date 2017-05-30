
<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
//require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}


	//$treat= new Treatment();
	$appoint= new Appointment();


	

	
	
	echo json_encode($appoint->getAppointmentToEdit($idAppointment));

?>

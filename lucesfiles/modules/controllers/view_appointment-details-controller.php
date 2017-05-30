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
	
	$details=$appoint->getAppointments_Details($idAppointment);

	echo "Áreas a tratar: ";
	foreach ($details as $detail) 
	{
		 echo $detail['0']." - ";
		
	}


?>
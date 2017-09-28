 <?php 	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require_once ("../class/treatment.class.php");
	require_once ("../class/appointment.class.php");

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}

	$appointment=new Appointment();
	$listA=$appointment->getAppointments_ByTreatment_Patient($idPatient,$idTreatment,$idBranch);
 ?>


 
<?php 

require_once ("../class/history.class.php");
require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");

foreach ($_POST as $key => $value) 
{
	$$key = $value;
}

//$flag=0;
//$patient= new History();
$appointment=new Appointment();
//$treat=new Treatment();


//Change date format
$startTimestamp = strtotime($start);
$startNewFormat = date('Y-m-d H:i:s', $startTimestamp);
$endTimestamp = strtotime($end);
$endNewFormat = date('Y-m-d H:i:s', $endTimestamp);

if($appointment->update_appointment_date($idAppointment,$startNewFormat,$endNewFormat))
{
	echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>Cambios guardados.<br> 
				Nueva fecha: '.$startNewFormat.'.</h4></div></div>';
}

else
{
	
	echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>Se ha producido un error al intentar guardar los cambios.<br>Por favor intente nuevamente o contacte con el administrador.</h4>
		 	    </div>
		      </div>';
}

?>
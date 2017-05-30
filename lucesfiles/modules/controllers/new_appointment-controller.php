<?php 

require_once ("../class/history.class.php");
require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");
require_once ("../class/sale.class.php");

foreach ($_POST as $key => $value) 
{
	$$key = $value;
}

$flag=0;
$patient= new History();
$appointment=new Appointment();
$treat=new Treatment();
$sale=new Sale();

//Change date format
$startTimestamp = strtotime($start);
$startNewFormat = date('Y-m-d H:i:s', $startTimestamp);
$endTimestamp = strtotime($end);
$endNewFormat = date('Y-m-d H:i:s', $endTimestamp);

//echo "tipo de cita:".$aType;
//die();

$idPatient=$patient->getIdPatient($identityCard);

session_start();
$idUser=$_SESSION['id_user'];

if($appointment->addAppoinment($idPatient,$startNewFormat,$endNewFormat,$idUser,$branch))
{
	//echo "cita guardada";
	$idAppointment=$appointment->getLastIdAppointment();

	for ($i=0 ; $i<sizeof($bodyareas) ;$i++) 
	{
		$idTreatment_BodyArea= $treat->getTreatment_BodyArea_ID($treatment,$bodyareas[$i]);

		if ($aType==1) 
		{
			//Warning
			$idTreatmentSale=$sale->getIdTreatmentSale($idTreatment_BodyArea);
			if($sale->updateTreatmentSale_AddAppointmentAndConsume($idAppointment,$idTreatmentSale))
				echo "Cita y Venta asociados";
			else
				echo "Se ha producido un error al asociar cita-venta";
		}

		if($appointment->addAppoinment_Treatment($idAppointment,$idTreatment_BodyArea))
		{
			//echo "Cita y tratamiento guardado No.".$i;
			$flag=1;
		}

		else
		{
			$flag=0;
		}
	}
}

if ($flag==1) 
{
	echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>Cita Asignada.<br> 
				Fecha: '.$startNewFormat.'.</h4></div></div>';
}


else
{
	echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>Se ha producido un error al registrar la cita.<br>Por favor intente nuevamente o contacte con el administrador.</h4>
		 	    </div>
		      </div>';
}

/*echo "id del paciente es:".$idPatient;

echo "La nueva fecha del inicio  es: ".$startNewFormat;
echo "-";
echo "La nueva fecha del final  es: ".$endNewFormat;


echo "el tratamiento es:".$treatment;

echo "el area del cuerpo es:".$bodyareas[0];*/

 ?>
<?php 

require_once ("../class/history.class.php");
require_once ("../class/treatment.class.php");
require_once ("../class/appointment.class.php");

foreach ($_POST as $key => $value) 
{
	$$key = $value;
}


// Verify if appointment exist
//Note: $appointment=date

$appoint= new Appointment();
$patient= new History();
$idPatient=$patient->getIdPatient($identityCard);
$appointment_to_delete=$appoint->appointment_exist($idPatient,$appointmentDate,$branch);
$match=0;
		
		if($appointment_to_delete)
		{

			//echo "la cita existe";
			foreach ($appointment_to_delete as $ap)
			{
				$idAppointment=$ap[0];
				/*$confirmed=$ap[1];
				$attended=$ap[2];*/

				$idTreatment=$appoint->getIdTreatmentByIdAppointment($idAppointment);

				 if ($idTreatment==$treatment) 
				 {
				 	if($appoint->deleteAppointment($idAppointment))
				 	{
				 		echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>La cita ha sido eliminada satisfactoriamente. 
									</h4></div></div>';
				 	}
				 	
				 	else
				 	{
				 		echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> <h4>Se ha producido un error al tratar de eliminar la cita.
									</h4></div></div>';
				 	}

				 	$match=1;
					break; //foreach
				 }

			}


			if ($match==0) 
			{
				echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> <h4>El tratamiento seleccionado no concuerda con ninguno agendado para esa fecha por el paciente.
					</h4></div></div>';
			}
		}


		else
		{
			echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> <h4>El paciente no tiene citas reservadas para la fecha indicada. Por favor verifique.
									</h4></div></div>';
		}

?>
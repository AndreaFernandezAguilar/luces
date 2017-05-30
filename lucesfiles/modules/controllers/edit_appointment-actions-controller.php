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
$appointment_to_edit=$appoint->appointment_exist($idPatient,$appointment,$branch);
$match=0;
		
		if($appointment_to_edit)
		{

			//echo "la cita existe";
			foreach ($appointment_to_edit as $ap)
			{
				$idAppointment=$ap[0];
				$confirmed=$ap[1];
				$attended=$ap[2];

				$idTreatment=$appoint->getIdTreatmentByIdAppointment($idAppointment);

				 if ($idTreatment==$treatment) 
				 {
				 		switch ($action)
					{
						case '1':
							if($confirmed==1)
							{
								echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissible" role="alert" style="text-align:center;"> <h4>La cita ya ha sido confirmada con anterioridad.
									</h4></div><!--</div><button id="back" class="big-btn-purple">Volver</button>--';

							}

							else
							{
								if($appoint->update_appointmentStatus_confirmed($idAppointment))
								{
			
									echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>La cita ha sido marcada como confirmada. 
									</h4></div></div>';
								}

								else
								{		
									echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> <h4>Se ha producido un error al tratar de cambiar el estatus de la cita.
									</h4></div></div>';
								}
							}	
						break;

						case '2':
							if(strtotime($appointment) > time())
							{
								echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> <h4>No puedes marcar como atendida una cita cuya fecha es mayor a la actual.
										</h4></div></div>';
								break;
							}

						if($attended==1)
							{
								
								echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissible" role="alert" style="text-align:center;"> <h4>La cita ya ha sido marcada como antendida anteriormente.
									</h4></div></div>';
							}

							else
							{
								if($appoint->update_appointmentStatus_attended($idAppointment))
								{
									
									echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>La cita ha sido marcada como atendida. 
									</h4></div></div>';
								}

								else
								{
									echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> <h4>Se ha producido un error al tratar de cambiar el estatus de la cita.
									</h4></div></div>';
								}
							}	
						break;


						case '3':
						echo "<br><br><br><div id='calendar'></div>";
						echo "<input type='hidden' id='idAppointment' value='".$idAppointment."'>";
						break;
							                                   	
						default:
						# code...
						break;
					}		                                   
					
					$match=1;
					break; //foreach
				}

				 

				


			} //end foreach	


			 	if($match==0)
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
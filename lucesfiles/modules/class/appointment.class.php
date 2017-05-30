<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("db.class.php");


class  Appointment extends Database
{

	public function getAllAppointment()
	{
		$sql = "SELECT start,end FROM appointment";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointments[] = array('title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end']);
						}

						return $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}




		public function addAppoinment($idPatient,$start,$end,$idUser,$idBranch)
	{
		$sql = "INSERT INTO appointment (idPatient,start,end,idUser,idBranch) VALUES('$idPatient','$start','$end','$idUser','$idBranch')";

			$consulta = $this->conn->query($sql);
			if ($consulta)
			{
				return TRUE;
			} 

			else 
			{
				die(($this->conn->error));
			}	
	}




		public function addAppoinment_Treatment($idAppointment,$idTreatment_BodyArea)
	{
		$sql = "INSERT INTO appointment_treatment_bodyarea (idAppointment,idTreatment_BodyArea) VALUES('$idAppointment','$idTreatment_BodyArea')";

			$consulta = $this->conn->query($sql);
			if ($consulta)
			{
				return TRUE;
			} 

			else 
			{
				die(($this->conn->error));
			}	
	}



	function getLastIdAppointment()
	{
		$idAppointment=$this->conn->insert_id;

		return $idAppointment;
	}




		public function getAppointments_ByTreatment_Machine($idMachine)
	{
		$sql ="SELECT distinct apo.idAppointment,ap.`start`,ap.`end` from treatment_bodyarea as tr_ba, treatment as tr inner join appointment_treatment_bodyarea as apo,appointment as ap where 
tr.idMachine='$idMachine' and tr.id= tr_ba.idTreatment and apo.idTreatment_BodyArea=tr_ba.id and apo.idAppointment=ap.id;";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointments[] = array('title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end']);
						}

						return $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}

	// Without the appointment to edit 
		public function getAppointments_ByTreatment_Machine_2($idMachine,$idAppointment,$branch)
	{
		$sql ="SELECT distinct apo.idAppointment,ap.`start`,ap.`end` from treatment_bodyarea as tr_ba, treatment as tr inner join appointment_treatment_bodyarea as apo,appointment as ap where 
tr.idMachine='$idMachine' and tr.id= tr_ba.idTreatment and apo.idTreatment_BodyArea=tr_ba.id and apo.idAppointment=ap.id and ap.idBranch='$branch' and ap.id!='$idAppointment'";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointments[] = array('id'=>$row['idAppointment'],'title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end']);
						}

						return $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function appointment_exist($idPatient,$appointment,$branch)
	{
		$sql= "SELECT * from appointment where idPatient='$idPatient' and DATE (`start`)='$appointment' and idBranch='$branch'";



		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointments[] = array($row['id'],$row['confirmed'],$row['attended']);
						}

						return $appointments;
						//return $result;
					} 

					else 
					{
						return;
					} 
				}
	}


	public function update_appointmentStatus_confirmed($idAppointment)
	{
		$sql ="UPDATE appointment set confirmed='1' where id=$idAppointment"; 
			
			
		$consulta = $this->conn->query($sql);

			if ($consulta)
			{
				return TRUE;
			} 

			else 
			{
				die(($this->conn->error));
			}	
	}



	public function update_appointmentStatus_attended($idAppointment)
	{
		$sql ="UPDATE appointment set attended='1' where id=$idAppointment"; 
			
			
		$consulta = $this->conn->query($sql);

			if ($consulta)
			{
				return TRUE;
			} 

			else 
			{
				die(($this->conn->error));
			}	
	}



	public function getIdTreatmentByIdAppointment($idAppointment)
	{
		$sql = "SELECT distinct idTreatment from treatment_bodyarea as tba, appointment_treatment_bodyarea as atba where atba.idAppointment='$idAppointment' and atba.idTreatment_BodyArea=tba.id; ";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $treatment = $row['idTreatment'];
						}

						return $treatment;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function getAppointmentToEdit($idAppointment)
	{

		$sql="SELECT id,`start`,`end` from appointment where id='$idAppointment'";
		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointment[] = array('id'=>$row['id'],'title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end']);
						}

						return $appointment;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function update_appointment_date($idAppointment,$start,$end)
	{
		$sql ="UPDATE appointment set `start`='$start',`end`='$end' where id=$idAppointment"; 
			
		$consulta = $this->conn->query($sql);

			if ($consulta)
			{
				return TRUE;
			} 

			else 
			{
				die(($this->conn->error));
			}	
	}




		public function getAppointments_ByTreatment_Patient($idPatient,$idTreatment,$idBranch)
	{
		$sql ="SELECT distinct ap.id,idPatient, ap.`start`,ap.`end` from appointment as ap,appointment_treatment_bodyarea as atb, treatment_bodyarea as tb where ap.idPatient='$idPatient' and ap.idBranch='$idBranch' and ap.id=atb.idAppointment and atb.idTreatment_BodyArea=tb.id and tb.idTreatment=$idTreatment";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointments[] = array('title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end'],'id'=>$row['id']);
						}

						return $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}



		public function getAppointments_ByTreatment_Branch($idTreatment,$idBranch)
	{
		$sql ="SELECT distinct ap.id,idPatient, ap.`start`,ap.`end`from appointment as ap,appointment_treatment_bodyarea as atb, treatment_bodyarea as tb 
		where ap.idBranch='$idBranch' and ap.id=atb.idAppointment and atb.idTreatment_BodyArea=tb.id and tb.idTreatment='$idTreatment'";
		
		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $appointments[] = array('title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end'],'id'=>$row['id']);
						}

						return $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}





		public function getAppointments_Details($idAppointment)
	{
		$sql ="SELECT ba.name from bodyarea as ba, treatment_bodyarea as tba, appointment_treatment_bodyarea atb 
		where atb.idAppointment='$idAppointment' and atb.idTreatment_BodyArea=tba.id and tba.idBodyArea=ba.id";
		
		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $details[] = array($row['name']);
						}

						return $details;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
	}


	public function deleteAppointment($id)
	{
			$sql = "DELETE from appointment where id= '$id'";
			$consulta = $this->conn->query($sql);
			
			
			if($consulta)
			{
				return true;
			}

			else
			{
				die(($this->conn->error));
			}
	}


		public function getAppointments_By_Patient($idPatient,$treatment,$branch)
	{
		$sql ="SELECT  appointment.id, appointment.`start`,appointment.`end` FROM appointment WHERE appointment.idPatient='$idPatient' and appointment.idBranch='$branch' 
		and  id NOT IN (SELECT distinct ap.id from appointment as ap,appointment_treatment_bodyarea as atb, treatment_bodyarea as tb where 
		ap.idPatient='$idPatient' and ap.idBranch='$branch' and ap.id=atb.idAppointment and atb.idTreatment_BodyArea=tb.id and tb.idTreatment='$treatment');";
		
		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						  $appointments[] = array('title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end'],'id'=>$row['id']);
						}

						return  $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
				
	}




		public function getAppointments_weekly($startW,$endW)
	{
		$sql ="SELECT  appointment.id, appointment.`start`,appointment.`end` FROM appointment WHERE `start` between '$startW' and '$endW'";
		
		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						  $appointments[] = array('title'=>'Cita', 'start'=>$row['start'],'end'=>$row['end'],'id'=>$row['id']);
						}

						return  $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
				
	}


		public function getAppointmentsList($idPatient,$treatment,$branch,$start,$end)
	{
		$sql ="SELECT  appointment.id, appointment.`start`,appointment.`end` FROM appointment WHERE appointment.idPatient='$idPatient' and appointment.idBranch='$branch' 
		and  id NOT IN (SELECT distinct ap.id from appointment as ap,appointment_treatment_bodyarea as atb, treatment_bodyarea as tb where 
		ap.idPatient='$idPatient' and ap.idBranch='$branch' and ap.id=atb.idAppointment and atb.idTreatment_BodyArea=tb.id and tb.idTreatment='$treatment');";
		
		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						  $appointments[] = array('id'=>$row['id'],'start'=>$row['start'],);
						}

						return  $appointments;
						//return $result;
					} 

					else 
					{
						return false;
					} 
				}
				
	}



}


?>
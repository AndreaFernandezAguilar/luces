<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("db.class.php");


class  History extends Database
{

	function getStates()
	{
		$sql = "SELECT * FROM state";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $states[] = array($row['id'], $row['name']);
						}

						return $states;
					} 

					else 
					{
						return false;
					} 
				}
	}


	function getMaritalStatus()
	{
		$sql = "SELECT * FROM marital_status order by id";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $m_status[] = array($row['id'], $row['name']);
						}

						return $m_status;
					} 

					else 
					{
						return false;
					} 
				}
	}


		function getCities($state)
	{
		$sql = "SELECT * FROM city where city.idState='$state'";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $cities[] = array($row['id'], $row['name']);
						   //echo $row['name'];
						}

						return $cities;
					} 

					else 
					{
						return false;
					} 
				}	
	}



	public function addPatient($identityCard,$name,$lastname,$maritalStatus,$phone,$mobile,$email,$ocupation,$referedBy,$birthday,$state,$city,$address,$gender,$idUser)
	{

			$sql = "INSERT INTO patient (identityCard,name,lastName,idMaritalStatus,phone,mobile,email,ocupation,referedBy,birthday,idState,idCity,address,gender,idUser)
			VALUES('$identityCard','$name','$lastname','$maritalStatus','$phone','$mobile','$email','$ocupation','$referedBy',
				'$birthday','$state','$city','$address','$gender','$idUser')";

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


	public function addMedicalHistory($idPatient,$identityCard,$values,$allergies,$numberOfPregnancys,$lastPeriod)
	{
		$sql ="INSERT into medical_history (idPatient,diabetes,hypertensive,keloids,cancer,arthritis,lupus,kidneyFailure,pacemaker,
			orthodonticDevice,tan,sunReactions,currentlyPregnant,sunBlemishes,smoking,workout,contraceptiveOrHormones,allergies,numberOfPregnancys,lastPeriod) 
			VALUES($idPatient,{$values['diabetes']},{$values['hypertensive']},{$values['keloids']},{$values['cancer']},{$values['arthritis']},{$values['lupus']},
				{$values['kidneyFailure']},{$values['pacemaker']},{$values['orthodonticDevice']},{$values['tan']},{$values['sunReactions']},{$values['currentlyPregnant']},
				{$values['sunBlemishes']},{$values['smoking']},{$values['workout']},{$values['contraceptiveOrHormones']},'$allergies',$numberOfPregnancys,'$lastPeriod')";

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

	public function getIdPatient($identityCard)
	{
		$sql ="SELECT id from patient where identityCard='$identityCard'"; 

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $idPatient = $row['id'];
						   
						}
						
						return $idPatient;
					} 

					
					else 
					{
						return false;
					} 
				}	
	}


	public function getIdentityCard($id)
	{
		$sql ="SELECT identityCard from patient where id='$id'"; 

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $identityCard = $row['identityCard'];
						   
						}
						
						return $identityCard;
					} 

					
					else 
					{
						return false;
					} 
				}	
	}


	public function getMedicalHistory_PersonalInformation($identityCard)
	{
		$sql = "SELECT *from patient where identityCard=$identityCard";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						    $personal_information[] = array($row['identityCard'],$row['name'],$row['lastName'],$row['gender'],$row['birthday'],$row['idMaritalStatus'],
						    $row['ocupation'],$row['address'],$row['idState'],$row['idCity'],$row['phone'],$row['mobile'],$row['email'],$row['referedBy']);
						   
						}
						
						return $personal_information;
					} 

					
					else 
					{
						return false;
					} 
				}	

	}


	public function getStateName($idSate)
	{
		$sql="SELECT name from state where id='$idSate'";
		$result = $this->conn->query($sql);


		if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $stateName = $row['name'];
						}

						return $stateName;
					} 

					else 
					{
						return false;
					} 
				}

	}

	public function getCityName($idCity)
	{
		$sql="SELECT name from city where id='$idCity'";
		$result = $this->conn->query($sql);


		if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $cityName = $row['name'];
						}

						return $cityName;
					} 

					else 
					{
						return false;
					} 
				}
	}


	public function getMaritalStatusName($idMaritalStatus)
	{
		$sql="SELECT name from marital_status where id='$idMaritalStatus'";
		$result = $this->conn->query($sql);


		if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $maritalStatusName = $row['name'];
						}

						return $maritalStatusName;
					} 

					else 
					{
						return false;
					} 
				}
	}


	public function getMedicalRecord($idPatient)
	{
		$sql = "SELECT *from medical_history where idPatient='$idPatient'";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						    $medical_record[] = array($row['diabetes'],$row['hypertensive'],$row['keloids'],$row['cancer'],$row['arthritis'],$row['lupus'],
						    $row['kidneyFailure'],$row['pacemaker'],$row['orthodonticDevice'],$row['tan'],$row['sunReactions'],$row['numberOfPregnancys'],$row['lastPeriod'],
						    $row['currentlyPregnant'],$row['allergies'],$row['sunBlemishes'],$row['smoking'],$row['workout'],$row['contraceptiveOrHormones']);
						   
						}
						
						return $medical_record;
					} 

					
					else 
					{
						return false;
					} 
				}	
	}



	public function setPatient($identityCard,$name,$lastname,$maritalStatus,$phone,$mobile,$email,$ocupation,$referedBy,$birthday,$state,$city,$address,$gender,$idUser)
	{
		$sql="UPDATE patient set identityCard='$identityCard',name='$name',lastName='$lastname',idMaritalStatus='$maritalStatus',
		phone='$phone',mobile='$mobile',email='$email',ocupation='$ocupation',referedBy='$referedBy',birthday='$birthday',
		idState='$state',idCity='$city',address='$address',gender='$gender',idUser='$idUser' where identityCard=$identityCard";

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




	public function setMedicalHistory($idPatient,$identityCard,$values,$allergies,$numberOfPregnancys,$lastPeriod)
	{

		$sql ="UPDATE medical_history set diabetes={$values['diabetes']} ,hypertensive={$values['hypertensive']},keloids={$values['keloids']},cancer={$values['cancer']},
					  arthritis={$values['arthritis']},lupus={$values['lupus']},kidneyFailure={$values['kidneyFailure']},pacemaker={$values['pacemaker']},
					  orthodonticDevice={$values['orthodonticDevice']},tan={$values['tan']},sunReactions={$values['sunReactions']},currentlyPregnant={$values['currentlyPregnant']},
					  sunBlemishes={$values['sunBlemishes']},smoking={$values['smoking']},workout={$values['workout']},contraceptiveOrHormones={$values['contraceptiveOrHormones']},
					  allergies='$allergies',numberOfPregnancys='$numberOfPregnancys',lastPeriod='$lastPeriod' where idPatient=$idPatient"; 
			
			
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


	public function getPatients_PersonalInformation()
	{
		$sql = "SELECT *from patient order by identityCard";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						    $personal_information[] = $row;
						   
						}
						
						return $personal_information;
					} 

					
					else 
					{
						return false;
					} 
				}	
	}


		public function deleteMedicalHistory($idPatient)
		{

			$sql = "DELETE from patient where id= '$idPatient'";
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
}


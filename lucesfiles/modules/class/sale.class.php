<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("db.class.php");


class  Sale extends Database
{

	function getSale($id)
	{
		$sql = "SELECT * FROM sale where id='$id'";

		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$sale = array($row['id'], $row['receiptNumber'],$row['dateTimeCreation'],$row['idBranch'],$row['idPatient']);
				}

				return $sale;
			} 

			else 
			{
				return false;
			} 
		}
	}



	function addSale($receiptNumber,$idUser,$idBranch,$idPatient)
	{
		$sql = "INSERT INTO sale (receiptNumber,idUser,idBranch,idPatient)
			VALUES('$receiptNumber','$idUser','$idBranch','$idPatient')";

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


	function addTreatmentSale($idSale,$idTreatmentBodyArea)
	{
		$sql = "INSERT INTO treatment_sale (idSale,idTreatmentBodyArea)
			VALUES('$idSale','$idTreatmentBodyArea')";

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



	function getLastIdSale()
	{
		$idSale=$this->conn->insert_id;

		return $idSale;
	}

	function sales_list($dateTimeCreation, $idPatient,$idBranch)
	{
		$sql="SELECT sale.id,sale.dateTimeCreation,idPatient,patient.name,patient.lastName,idBranch,branch.name as branchName from sale,patient,branch where ";

		if($dateTimeCreation!=null)
		{
			$sql.="sale.dateTimeCreation='$dateTimeCreation'";

			if ($idPatient!=null) 
			{
				$sql.="and sale.idPatient='$idPatient'";
			}

			if($idBranch!=0)
			{
				$sql.="and sale.idBranch='$idBranch'";
			}
		}

		elseif ($idPatient!=null) 
		{
			$sql.="sale.idPatient='$idPatient'";

			if($idBranch!=0)
			{
				$sql.="and sale.idBranch='$idBranch'";
			}

		}

		else
		{
			$sql.="sale.idBranch='$idBranch'";
		}

		$sql.="and patient.id=sale.idPatient and branch.id=sale.idBranch";

		//echo $sql;
		//die();
		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$sales[] = array($row['id'],$row['dateTimeCreation'],$row['idPatient'],$row['name'],$row['lastName'],$row['idBranch'],$row['branchName']);
				}

				return $sales;
			} 

			else 
			{
				return false;
			} 
		}
	}


	function getPaidTreatments($idSale)
	{
		$sql = "SELECT idTreatmentBodyArea,count(idTreatmentBodyArea) as quantity,tba.idTreatment,tba.idBodyArea from treatment_sale as ts,treatment_bodyarea as tba 
		where idSale='$idSale' and ts.idTreatmentBodyArea=tba.id
		group by idTreatmentBodyArea having count(idTreatmentBodyArea);";

		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$paidTreatments [] = array($row['idTreatmentBodyArea'], $row['quantity'],$row['idTreatment'],$row['idBodyArea']);
				}

				return $paidTreatments;
			} 

			else 
			{
				return false;
			} 
		}
	}




	public function deleteTreatmentsBySale($idSale,$idTreatmentBodyArea,$quantityToDelete)
	{
		$sql = "DELETE from treatment_sale where idSale='$idSale' and idTreatmentBodyArea='$idTreatmentBodyArea' and consumed=0 and idAppointment is NULL LIMIT  ".$quantityToDelete.";";

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


	/*Delete all treatments by bodyarea from a Sale --- Mix with prev*/

	public function deleteTreatmentByBodyAreaFromSale($idSale,$idTreatmentBodyArea)
	{
		$sql = "DELETE from treatment_sale where idSale='$idSale' and idTreatmentBodyArea='$idTreatmentBodyArea' and consumed=0 and idAppointment is NULL;";

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


	public function treatmentExistOnSale($idSale,$idTreatmentBodyArea)
	{
		$sql = "SELECT * from treatment_sale where idSale='$idSale' and idTreatmentBodyArea='$idTreatmentBodyArea' and consumed=0";

		$result = $this->conn->query($sql);


		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				return true;
			} 


			else 
			{
				return false;
			} 
		}
	}



	function updateTreatmentSale_AddAppointmentAndConsume($idAppointment,$idTreatmentSale)
	{
		
		$sql ="UPDATE treatment_sale set consumed=1, idAppointment='$idAppointment' where id='$idTreatmentSale'"; 
			
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




	function getIdTreatmentSale($idTreatmentBodyArea)
	{
		$sql="SELECT id FROM treatment_sale where idTreatmentBodyArea='$idTreatmentBodyArea' and consumed=0 limit 1 ";

		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$idTreatmentSale = $row['id'];
				}

				return $idTreatmentSale;
			} 

			else 
			{
				return false;
			} 
		}
	}

}

?>
<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("db.class.php");


class  Treatment extends Database
{

	public function getTreatmentsList()
	{
		$sql = "SELECT * FROM treatment order by name";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $treatments[] = array($row['id'], $row['name']);
						}

						return $treatments;
					} 

					else 
					{
						return false;
					} 
				}
	}




	public function getTreatment_BodyArea($treatment)
	{
		$sql = "SELECT ba.id,ba.name from bodyarea as ba,treatment_bodyarea as tba where tba.idTreatment=$treatment and ba.id=tba.idBodyArea order by name";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $treatments[] = array($row['id'], $row['name']);
						}

						return $treatments;
					} 

					else 
					{
						return false;
					} 
				}
	}


	public function getTreatmentName($idTreatment)
	{
		$sql = "SELECT name FROM treatment where id='$idTreatment'";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $treatment_name= $row['name'];
						}

						return $treatment_name;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function getBodyAreaName($idBodyArea)
	{
		$sql = "SELECT name FROM bodyarea where id='$idBodyArea'";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $bodyarea_name= $row['name'];
						}

						return $bodyarea_name;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function getTreatment_BodyArea_ID($treatment,$bodyarea)
	{
		$sql = "SELECT id from treatment_bodyarea where idTreatment=$treatment and idBodyArea=$bodyarea;";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $treatment = $row['id'];
						}

						return $treatment;
					} 

					else 
					{
						return false;
					} 
				}
	}


	public function getTreatment_BodyArea_suggestedTime($treatment,$bodyarea)
	{
		$sql = "SELECT suggestedTime from treatment_bodyarea where idTreatment=$treatment and idBodyArea=$bodyarea;";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $suggestedTime = $row['suggestedTime'];
						}

						return $suggestedTime;
					} 

					else 
					{
						return false;
					} 
				}
	}




	public function getMachine($treatment)
	{
		$sql = "SELECT idMachine from treatment where id=$treatment;";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $idMachine = $row['idMachine'];
						}

						return $idMachine;
					} 

					else 
					{
						return false;
					} 
				}
	}



	public function getTreatments_BodyArea_ByMachine($idMachine)
	{
		$sql="SELECT tr_ba.id from treatment_bodyarea as tr_ba, treatment as tr where tr.idMachine='$idMachine' and tr.id= tr_ba.idTreatment;";

		$result = $this->conn->query($sql);

				if ($result) 
				{
					if ($result->num_rows > 0) 
					{
						while ($row = mysqli_fetch_assoc($result))
						{
						   $treatments_bodyArea [] =  array($row['id']);
						}

						return $treatments_bodyArea;
					} 

					else 
					{
						return false;
					} 
				}
	}


		public function getTreatments_Prepaid($idPatient,$idBranch)
	{
		$sql = "SELECT DISTINCT tr.id as idTreatment,tr.name as treatmentName from sale as sa,treatment_sale as ts, treatment_bodyarea  as tba, treatment as tr, bodyarea as bda where sa.idPatient='$idPatient' and sa.idBranch='$idBranch' and ts.idSale=sa.id and tba.id=ts.idTreatmentBodyArea and tba.idTreatment=tr.id and tba.idBodyArea=bda.id and ts.consumed=0";
		

		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$treatments[] = array($row['idTreatment'], $row['treatmentName']);
				}

				return $treatments;
			} 

			else 
			{
				return false;
			} 
		}
	}



	public function getBodyareaBy_Treatments_Prepaid($idTreatment)
	{
		$sql = "SELECT distinct tr.id as idTreatment, bda.id as idBodyarea, bda.name as bodyareaName from sale as sa,treatment_sale as ts, treatment_bodyarea  as tba,treatment as tr, bodyarea as bda where sa.idPatient=56 and sa.idBranch=1 and ts.idSale=sa.id and tba.id=ts.idTreatmentBodyArea and tba.idTreatment=tr.id and tba.idBodyArea=bda.id  and ts.consumed=0 and tba.idTreatment='$idTreatment'";
		

		$result = $this->conn->query($sql);

		if ($result) 
		{
			if ($result->num_rows > 0) 
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$bodyareas[] = array($row['idBodyarea'], $row['bodyareaName']);
				}

				return $bodyareas;
			} 

			else 
			{
				return false;
			} 
		}
	}




}

<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
//require_once ("../class/treatment.class.php");
require_once ("../class/sale.class.php");

$sale=new Sale();

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;

	}

	echo "Agregar:";
	echo "<br>";

	if (isset($toInsert)) 
	{
		foreach ($toInsert as $toI)
		{
			echo $toI["quantity"];
			echo "<br>";
			echo $toI["idTreatmentBodyArea"];
			echo "<br>";

			for ($i=0; $i < $toI["quantity"]; $i++) 
			{ 
				$sale->addTreatmentSale($idSale, $toI["idTreatmentBodyArea"]);
			}

		}
	}
	
	echo"Eliminar";
	if (isset($toDelete)) 
	{
		foreach ($toDelete as $toD)
		{
			echo $toD["quantity"];
			echo "<br>";
			echo $toD["idTreatmentBodyArea"];
			echo "<br>";

			$sale->deleteTreatmentsBySale($idSale,$toD["idTreatmentBodyArea"],$toD["quantity"]);
		}
	}

	//$treat= new Treatment();
	$sale= new Sale();


	

	
	
	//echo json_encode(sale->getAppointmentToEdit($idAppointment));

?>

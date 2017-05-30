<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");
require_once ("../class/sale.class.php");
require_once ("../class/history.class.php");


// Validate Fields

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}
//

	$flag=0;
	$patient= new History();
	$idPatient=$patient->getIdPatient($identityCard);

	session_start();
	$idUser=$_SESSION['id_user'];

	$sale = new Sale();
	$treat= new Treatment();

	if($sale->addSale($receiptNumber,$idUser,$branch,$idPatient))
{	
	$idSale=$sale->getLastIdSale();

	for ($i=0 ; $i<sizeof($treatments_s) ;$i++) 
	 {
	 	
	 	$treatment=$treatments_s [$i];
	 	$bodyarea=$bodyareas_s [$i];
	 	$numb_treat=$numberOfTreatments_s[$i];
	 	$idTreatmentBodyArea=$treat->getTreatment_BodyArea_ID($treatment,$bodyarea);

	 	for ($j=0; $j<$numb_treat; $j++) 
	 	{ 
		 	if($sale->addTreatmentSale($idSale,$idTreatmentBodyArea))
		 	{
		 		$flag=1;
		 	}
		 	
		 	else
	 		$flag=0;	
	 	}
	 	
	 }
			
}


		if($flag==1)
		{
				echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>Venta Registrada<br> 
				Exitosamente.</h4></div></div>';
		}

	
 ?>
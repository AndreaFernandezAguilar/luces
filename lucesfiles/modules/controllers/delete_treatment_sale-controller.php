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



if($sale->treatmentExistOnSale($idSale,$idTreatmentBodyArea))
	
	if($sale->deleteTreatmentByBodyAreaFromSale($idSale,$idTreatmentBodyArea))
	echo "1";

	else
		echo "2";

else
	echo "0";



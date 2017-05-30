<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");


	$treat= new Treatment();



	if (isset($_REQUEST['opc']))
		$opc=$_REQUEST['opc'];

	else
		$opc=0;


	if ($opc!=0) 
	{
		echo '<select multiple="multiple" class="SlectBox" id="bodyarea" name="bodyarea">';
		
	}

	else
	{
		echo '<select class="SlectBox" id="bodyarea" name="bodyarea">';
		echo '<option value="0" selected>Seleccione...</option>';
	}


	if ($opc==2)
	{	
		//$bodyareas= $treat->getTreatment_BodyArea($_REQUEST['treatment']);
		$bodyareas=$treat->getBodyareaBy_Treatments_Prepaid($_REQUEST['treatment']);
		
	}

	else
	{
		$bodyareas= $treat->getTreatment_BodyArea($_REQUEST['treatment']);
	}

	foreach ($bodyareas as $bodyarea) 
	{
		echo "<option value='".$bodyarea[0]."'>".$bodyarea[1]."</option>";
	}


	echo "</select>";


 ?>
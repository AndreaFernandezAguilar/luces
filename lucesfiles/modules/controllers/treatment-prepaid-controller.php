<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");
require_once ("../class/history.class.php");



	$treat= new Treatment();
	$patient=new History();

	$idPatient=$patient->getIdPatient($_REQUEST['identityCard']);

	if($_REQUEST['aType']==1)
		$treatments= $treat->getTreatments_Prepaid($idPatient,$_REQUEST['branch']);

	else
		$treatments=$treat->getTreatmentsList();					


	/*if (isset($_REQUEST['opc']))
		$opc=$_REQUEST['opc'];

	else
		//$opc=0;*/


	


		echo '<select class="SlectBox" id="treatment-select-box" name="treatment-select-box">';
		echo '<option value="0" selected>Seleccione...</option>';
	


	
	foreach ($treatments as $treatment) 
	{
		
		echo "<option value='".$treatment[0]."'>".$treatment[1]."</option>";
	}


	echo "</select>";

	//echo "testing";


 ?>
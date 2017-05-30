<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/history.class.php");


	$history= new History();

	$cities= $history->getCities($_REQUEST['state']);

	echo '<select class="SlectBox" id="city-select-box" name="city">';
	echo '<option value="0" selected>Seleccione...</option>';
	foreach ($cities as $city) 
	{
		
		echo "<option value='".$city[0]."'>".$city[1]."</option>";
	}

echo "</select>";


 ?>
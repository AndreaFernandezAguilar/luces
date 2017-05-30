<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");

//echo "blabla";
$suggestedTime=0;
$treat= new Treatment();
$treatment=$_REQUEST['treatment'];
//$bodyareas = explode(",",$_REQUEST['bodyareas']);
$bodyareas=$_REQUEST['bodyareas'];
//echo "el primer tratamiento es: ".$bodyareas[0];

//echo "tamaño del arreglo: ".sizeof($bodyareas);

		for ($i=0; $i <sizeof($bodyareas) ; $i++) 
	{ 

		 $suggestedTime=$suggestedTime+$treat->getTreatment_BodyArea_suggestedTime($treatment,$bodyareas[$i]);
		
	}


	

	echo $suggestedTime;
?>
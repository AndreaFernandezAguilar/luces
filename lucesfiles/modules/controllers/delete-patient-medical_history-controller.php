<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/history.class.php");


$identityCard=$_POST['identityCard'];

$history= new History();
$idPatient=$history-> getIdPatient($identityCard);
if($history->deleteMedicalHistory($idPatient))
echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4> Se ha eliminado la historia médica.<br> 
			Satisfactoriamente.</h4></div></div>';

else
echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissible" role="alert" style="text-align:center;"> <h4>El paciente no tiene historia médica registrada.<br> 
			</h4></div></div>';			
?>
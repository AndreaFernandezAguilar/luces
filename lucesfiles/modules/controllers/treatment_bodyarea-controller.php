<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/treatment.class.php");
require_once ("../class/sale.class.php");


$treat=new Treatment();
$sale= new Sale();

$idTreatment=$_REQUEST['treatmentSelected'];
$idBodyArea=$_REQUEST['bodyAreaSelected'];
$numberOfTreatments=$_REQUEST['numberOfTreatments'];
$count=$_REQUEST['count'];

if(isset($_REQUEST['idSale']))
	$idSale=$_REQUEST['idSale'];

$idTBA=$treat->getTreatment_BodyArea_ID($idTreatment,$idBodyArea);

if(isset($idSale))
{
	if($sale->treatmentExistOnSale($idSale,$idTBA))
	echo $idTBA;	
}

else
{
	echo "NO es edit";
	if(isset($_REQUEST['editQ']))
	$editQ=$_REQUEST['editQ'];

	if($treatment_name= $treat->getTreatmentName($idTreatment))
	echo '<tr id="tr_'.$idTBA.'"><td class="col-md-3"> '.$treatment_name.'</td>';



	if($BodyArea_name= $treat->getBodyAreaName($idBodyArea))
	echo '<td class="col-md-3">'.$BodyArea_name.'</td>';

	//echo '<td>'.$count.'</td>';

	//if(isset($editQ))
	echo '<td class="col-md-3">
			<div class="col-md-8 col-md-offset-2">
				<input type="number" class="newQ form-control" name="" id="newQ_'.$idTBA.'" value="'.$numberOfTreatments.'" min="1">
			</div>
		</td>
		<td class="col-md-1">
			<button class="btn btn-circle delete-treatment" type="button" id="dbutton_'.$idTBA.'"><span class="glyphicon glyphicon-remove"></span></button>
		</td>
		</tr>';

	/*else
	echo '<td>'.$numberOfTreatments.'</td></tr>';*/

	echo '<input type="hidden" class="treat_class" name="treatment_'.$count.'" value="'.$idTreatment.'">';
	echo '<input type="hidden" class="b_area_class" name="bodyarea_'.$count.'" value="'.$idBodyArea.'">';
	echo '<input id="currentQ_'.$idTBA.'" name="currentQ_'.$idTBA.'" type="hidden" readonly value="0" class="currentQ">';
	echo '<input type="hidden" class="n_treat_class" name="numberOfTreatments_'.$count.'" value="'.$numberOfTreatments.'">';
	echo '<input id="idTB_'.$idTBA.'" name="idTB_'.$idTBA.'" type="hidden" readonly value="'.$idTBA.'" class="idTB">';
	echo '<input type="hidden" name="count" value="'.$count.'">';

}
 ?>
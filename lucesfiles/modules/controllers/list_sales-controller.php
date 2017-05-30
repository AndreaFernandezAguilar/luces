<?php 	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require_once ("../class/treatment.class.php");
	require_once ("../class/sale.class.php");
	require_once ("../class/history.class.php");

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}

	$patient= new History();

	$idPatient=$patient->getIdPatient($identityCard);


	$sale= new Sale();

	if($list_sales=$sale->sales_list($dateTimeCreation, $idPatient,$idBranch))
	{
		foreach ($list_sales as $sale) 
		{
			echo "<tr>
		 	<td>".$sale[1]."</td>
		 	<td>".$sale[3]." ".$sale[4]."</td>
		 	<td>".$sale[6]."</td>
		 	<td><a href='edit_sale.php?id_sale=".$sale[0]."' style='color: #7E3F9D;'><i class='glyphicon glyphicon-edit'></i></a></td></tr>";
		}
	}

	else
	{	
		echo 'No se han encontrado resultados que coincidan con su búsqueda';
	}
	
 ?>


 
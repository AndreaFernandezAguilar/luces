<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/history.class.php");



// Validate Fields

	foreach ($_POST as $key => $value) 
	{
		$$key = $value;
	}


	if ($patient_name =="" || $patient_lastname=="" || $patient_gender=="" || $birthday=="" ||$idcard=="" || $maritalStatus=="" || $ocupation=="" || $address=="" || 
	$state=="0" || $city=="0") 
	{
		echo '<div class="row" style="margin-top:50px;">
				<div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
					<h4>Se han enviado algunos campos requeridos en blanco.<br>Por favor verifique.</h4>
		 	    </div>
		      </div>';
		die();
	}


// Look into database if the patient exists

	$identityCard=$_REQUEST['idcard'];
	$patient=new History();
	$patient_e=$patient->getIdPatient($identityCard);

	if($patient_e)
	{
		echo '<div class="row" style="margin-top:50px;"><div class="col-md-6 col-md-offset-3 alert alert-danger alert-dismissible" role="alert" style="text-align:center;"> 
		<h4>El Paciente ya está Registrado.<br> 
		Verifique el número de cédula o proceda a editar la historia.</h4></div></div>';
	}



	else
	{		

	// Patient - Personal Information

	$name=$_REQUEST['patient_name'];
	$lastname=$_REQUEST['patient_lastname'];
	$gender=$_REQUEST['patient_gender'];
	//$birthday=$_REQUEST['birthday'];
	$maritalStatus=$_REQUEST['maritalStatus'];
	$ocupation=$_REQUEST['ocupation'];
	$address=$_REQUEST['address'];
	$state=$_REQUEST['state'];
	$city=$_REQUEST['city'];
	$mobile=$_REQUEST['mobile_code'].$_REQUEST['mobile_number'];
	$phone=$_REQUEST['phone_code'].$_REQUEST['phone_number'];
	$email=$_REQUEST['email'];
	$referedBy=$_REQUEST['referedBy'];



	// Patient - Medical History


	$allergies=$_REQUEST['allergies'];
	$numberOfPregnancys=$_REQUEST['numberOfPregnancys'];

	if ($numberOfPregnancys=="") 
	{
		$numberOfPregnancys=0;
	}

	//echo "cedula:".$identityCard;
	//echo "embarazos:".$numberOfPregnancys;
	//die();
	$lastPeriod=$_REQUEST['lastPeriod'];



	$columns = array('diabetes','hypertensive','keloids','cancer','arthritis','lupus','kidneyFailure','pacemaker',
				'orthodonticDevice','tan','sunReactions','currentlyPregnant','sunBlemishes','smoking','workout','contraceptiveOrHormones') ; 

	if(isset($_REQUEST['medical_history']))
	{
	$medical_history=$_REQUEST['medical_history'];
	$values = array(); 

	 	foreach($columns as $column)
	 	{ 

		      if(in_array($column, $medical_history))
		      { 
		         $values[ $column ] = 1; 
		      } 
		      else 
		      { 
		         $values[ $column ] = 0; 
		      } 
		}

	}

	else
	{

		foreach($columns as $column)
	 	{ 

		         $values[ $column ] = 0;       


		}

	}
		

	//
	session_start();
	$idUser=$_SESSION['id_user'];


	$patient->addPatient($identityCard,$name,$lastname,$maritalStatus,$phone,$mobile,$email,$ocupation,$referedBy,$birthday,$state,$city,$address,$gender,$idUser);

	$idPatient= $patient->getIdPatient($identityCard);


	$patient->addMedicalHistory($idPatient,$identityCard,$values,$allergies,$numberOfPregnancys,$lastPeriod);


		echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-success alert-dismissible" role="alert" style="text-align:center;"> <h4>Paciente Registrado<br> 
			Exitosamente.</h4></div></div>';
			


	}

?>
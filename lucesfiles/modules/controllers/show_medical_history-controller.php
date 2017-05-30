<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/history.class.php");

$identityCard=$_POST['identityCard'];

$history= new History();
$personal_inf=$history->getMedicalHistory_PersonalInformation($identityCard);
$idPatient=$history-> getIdPatient($identityCard);
$medical_record=$history->getMedicalRecord($idPatient);
$buttonAction=0;


if($personal_inf)
{
	$buttonAction=1;
	echo'<form id ="form-medical-history" method="POST" action="report_by_patient.php"><div class = "row" style="margin-top:50px;">
			<div class = "page-header">
				<h4>Datos Personales del Paciente</h4>
			</div>	
		</div> 

		<div class = "row" >
			<div class = "col-md-10 col-md-offset-1">
				<table class="table table-bordered" id="illness-record-table">';

		foreach ($personal_inf as $inf) 
		{
			$maritalStatusName=$history->getMaritalStatusName($inf[5]);
			$stateName=$history->getStateName($inf[8]);
			$cityName=$history->getCityName($inf[9]);
			
			if($inf[3]=="F" || $inf[3]=='f')
			{
				$gender="Femenino";
			}

			else
			{
				$gender="Masculino";
			}
			

			echo "<tr>";
			echo "<td><strong>Cédula de Identidad: </strong>".$inf[0] ."</td>"."<td><strong>Nombre : </strong>".$inf[1]." ".$inf[2]."</td>
				<input type='hidden' class='form-control' id='idcard' name='idcard' value='".$inf[0]."'>";
			echo "<tr>";

			echo "<tr>";
			echo "<td><strong>Género: </strong>".$gender."</td>"."<td><strong>Fecha de Nacimiento: </strong>".$inf[4]."</td>";
			echo "<tr>";

			echo "<tr>";
			echo "<td><strong>Estado Civil: </strong>".$maritalStatusName."</td>"."<td><strong>Ocupación: </strong>".$inf[6]."</td>";
			echo "<tr>";

			echo "<tr>";
			echo "<td colspan=><strong>Dirección de Habitación: </strong>".$inf[7] ."</td>";
			echo "<td><strong>Números de Contacto: </strong><br>".$inf[10] ."<br>".$inf[11]."</td>";
			echo "<tr>";


			echo "<tr>";
			echo "<td><strong>Estado: </strong>".$stateName."</td>"."<td><strong>Ciudad: </strong>".$cityName."</td>";
			echo "<tr>";

			echo "<tr>";
			echo "<td><strong>Correo Electrónico: </strong>".$inf[12] ."</td>"."<td><strong>Referido por: </strong>".$inf[13]."</td>";
			echo "<tr>";

		}

		echo "</table>
		      </div>
		      </div>";
		}

		else
		{
			echo '<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4 alert alert-warning alert-dismissible" role="alert" style="text-align:center;"> <h4>Paciente no registrado.<br> 
			Verifique el número de cédula.</h4></div></div>';
		}


if($medical_record)
{
	echo '
		<div class = "row" style="margin-top:50px;">
			<div class = "page-header">
				<h4>Antecedentes Médicos del Paciente</h4>
			</div>	
		</div> 

		 <div class = "row" >
			<div class = "col-md-10 col-md-offset-1">
				<table class="table table-bordered" >';

	foreach ($medical_record as $m_record) 
	{

		

		/*<?php if ($states as $state): ?>
		                                    <option value="<?php echo $state['0'] ?>"><?php echo $state['1'] ?></option>
		                        <?php endif ?> */
		echo '<table class="table table-bordered" id="illness-record-table">
						<tr>
							 <td class="col-md-1">';
							
							if ($m_record[0]==1)
							echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="diabetes" readonly checked />';
							
							else
							echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" readonly  value="diabetes" />';
							
							 
							echo '</td>

						     <td class="field-label col-md-5">
						     	<p class="page-text">Diabetes</p>
						     </td>

						     <td class="field-label col-md-1">';
						     	
						     	if ($m_record[8]==1)
						     	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="orthodonticDevice" checked/>';

						     	else
						     	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="orthodonticDevice" />';
													    
						    echo  '</td>

						    <td class="field-label col-md-5">
						    	<p class="page-text">Prótesis dental o metálicas</p>
						    </td>
					  	</tr>

					  	<tr>
					  		<td class="field-label col-md-1">';

					  		if ($m_record[1]==1)
					  		echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="hypertensive"  checked/>';
					  		
					  		else
					  		echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="hypertensive" />';

					  		echo '</td>

						    <td class="field-label col-md-5">
						    	<p class="page-text">Hipertensión</p>
						    </td>

						    <td class="field-label col-md-1">';
						    	
						    if ($m_record[15]==1)
						    echo	'<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="sunBlemishes" checked/>';

							else
							echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="sunBlemishes"/>';
								
 						    echo '</td>

						    <td class="field-label col-md-5">
						    	<p class="page-text">Manchas en la piel</p>
						    </td>
					  	</tr>

					  	<tr>
						   <td class="field-label col-md-1">';

						   if ($m_record[2]==1)
						   echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="keloids" checked/>';

						   else
						   echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="keloids" />';

						   echo '</td>

						   <td class="field-label col-md-5">
						   		<p class="page-text">Queloides</p>
						   </td>

						   <td class="field-label col-md-1">';

						    if ($m_record[9]==1)
						   	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="tan" checked/>';

						    else
						    echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="tan" />';

						  echo '</td>

						   <td class="field-label col-md-5">
						   		<p class="page-text">Bronceado</p>
						   </td>

					  	</tr>

					  	<tr>
		 				  <td class="field-label col-md-1">';

		 				    if ($m_record[3]==1)
		 				  	echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="cancer" checked/>';

		 				  	else
		 				  	echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="cancer" />';
		 				  
		 				  echo '</td>

						  <td class="field-label col-md-5">
						  	<p class="page-text">Cáncer </p>
						  </td>

						   <td class="field-label col-md-1">';

		 				    if ($m_record[10]==1)
						   	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="sunReactions" checked />';

						   	else
						   	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="sunReactions" />';
						   
						   echo'</td>

						  <td class="field-label col-md-5">
						  	<p class="page-text">Reacciones al Sol</p>
						  </td>

					  	</tr>
					  	
					  	<tr>
					  		<td class="field-label col-md-1">';

					  			if ($m_record[4]==1)
					  			echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]"  value="arthritis" checked/>';

					  			else
					  			echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]"  value="arthritis"/>';
					  				
					  		echo '</td>

					  	    <td class="field-label col-md-5">
					  	    	<p class="page-text">Artritis</p>
					  	    </td>
					  	  

					  	    <td class="field-label col-md-1">';

					  	    	if ($m_record[5]==1)
					  	    	echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="lupus" checked/>';

					  	    	else
					  	    	echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="lupus"/>';

					  	    echo '</td>

						   <td class="field-label col-md-5">
						   	<p class="page-text">Lupus</p>
						   </td>
						     
					  	</tr>

					  	<tr>
		 				  <td class="field-label col-md-1">';
		 				  	
		 				  		if ($m_record[16]==1)
		 				  		echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="smoking" checked/>';

		 				  		else
		 				  		echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="smoking"/>'; 
		 				 
		 				  echo '</td>

						  <td class="field-label col-md-5">
						  	<p class="page-text">Fumador (a) </p>
						  </td>

						   <td class="field-label col-md-1">';

						    	if ($m_record[18]==1)
						   		echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="contraceptiveOrHormones" checked/>';

						   		else
						   		echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="contraceptiveOrHormones"/>';
						  
						   echo '</td>

						  <td class="field-label col-md-5">
						  	<p class="page-text">Hormonas y/o Anticonceptivos</p>
						  </td>
					  	</tr>
					  

					 	<tr>
				  		    <td class="field-label col-md-1">';

				  		    	if ($m_record[7]==1)
				  		    	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="pacemaker" checked/>';

				  		    	else
				  		    	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="pacemaker" />';

				  		   echo '</td>

						    <td class="field-label col-md-5">
						    	<p class="page-text">Marcapaso</p>
						    </td>

						    <td class="field-label col-md-1">';

						    	if ($m_record[17]==1)
						    	echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="workout" checked/>';

						    	else
						    	echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="workout" />';
						   
						    echo '</td>

						    <td class="field-label col-md-5">
						    	<p class="page-text">Ejercicios</p>
						    </td>

					  	</tr>

						<tr>
							
						    <td class="field-label col-md-1">';
						    	if ($m_record[6]==1)
						    	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="kidneyFailure" checked/>';

						    	else
						    	echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="kidneyFailure"/>';

						    echo '</td>

						    <td class="field-label col-md-5">
						    	<p class="page-text">Insuficiencia Renal</p>
						    </td>

						   <td class="field-label col-md-1">';
					  			if ($m_record[13]==1)
					  			echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="currentlyPregnant" checked/>';

					  			else
					  			echo '<input type="checkbox" class="inline-checkbox" id=""  name="medical_history[]" value="currentlyPregnant"/>';

					  		echo '</td>

						     <td class="field-label col-md-5">
						     	<p class="page-text">Actualmente embarazada</p>
						     </td>
					  		
					  	</tr>

					  	<tr>

							 <td class="field-label" colspan="2">
						    	<p class="page-text col-md-6" style="margin-left:5px;">Último Periodo</p>
						    	<input type="text" placeholder="aaaa-mm-dd" class="form-control datepicker" style="max-width: 120px" name="lastPeriod" readonly value="'.$m_record[12].'" style="max-width:120px;"/>
						    </td>


					  		

					  	  	<td class="field-label col-md-6" colspan="2">
					  	  		<p class="page-text">Embarazos</p>
						        <div style="display: inline-block;">
								  <input type="number" class="form-control" id="numberOfPregnancys"  name="numberOfPregnancys" min="0" max="15" value="'.$m_record[11].'"style="max-width:100px;" readonly>
						        </div>
					        </td>   
							
						    
					  	</tr>

					  	<tr>
					  		<td class="field-label col-md-1">';
					  			if ($m_record[14]!='')
					  			echo '<input type="checkbox" class="inline-checkbox" id="" name="" checked/>';

					  			else
					  			echo '<input type="checkbox" class="inline-checkbox" id="" name="" />';
					  		
					  		echo '</td>

					  		<td class="field-label" colspan="4">
					  			<p class="page-text col-md-2">Alergias</p>

					  			<input type="text" class="form-control " placeholder="" style="max-width:550px;" id="" name="allergies" readonly value="'.$m_record[14].'"/>
					  		</td>


					  	</tr>


					</table>
					</div>
					</div>';

	}


	if ($buttonAction==1 && $_POST['oper']=="view")
	{
		echo'<div class="row" style="text-align:center;">
			<div class="col-md-4 col-md-offset-4">
				<button  class="big-btn-purple" type="submit" style="margin-top: 40px; margin-bottom: 50px;">Generar Reporte</button>
			</div>
		</div>';

	} 

	elseif ($buttonAction==1 && $_POST['oper']=="delete") 
	{
		echo'<div class="row" style="text-align:center;">
				<div class="col-md-4 col-md-offset-4">
					<button  class="big-btn-purple" type="submit" style="margin-top: 40px; margin-bottom: 50px;">Borrar Antecedentes</button>
				</div>
		</div> </form>';
	}

}

?>
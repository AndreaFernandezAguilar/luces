<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once ("../class/history.class.php");





$button=0;
$identityCard=$_POST['identityCard'];

$history= new History();
$personal_inf=$history->getMedicalHistory_PersonalInformation($identityCard);
$idPatient=$history-> getIdPatient($identityCard);
$medical_record=$history->getMedicalRecord($idPatient);
$states = $history->getStates();
$m_status=$history->getMaritalStatus();




if($personal_inf)
{

	$button=1;

	/*echo'<div class = "row" style="margin-top:50px;">
			<div class = "page-header">
				<h4>Datos Personales del Paciente</h4>
			</div>	
		</div> '; */


		echo ' <form action="../modules/controllers/patient-modify-controller.php" method="POST" class="form-horizontal" role="form" id="form-medical-history">
		<div class="row">
				<div class="page-header"><br><br>
					<h4>Datos Personales del Paciente</h4>
				</div>
		</div>';

		foreach ($personal_inf as $inf) 
		{   

			$maritalStatusName=$history->getMaritalStatusName($inf[5]);
			$m_status=$history->getMaritalStatus();
			$stateName=$history->getStateName($inf[8]);
			$cities= $history->getCities($inf[8]);
			$cityName=$history->getCityName($inf[9]);
			$phone_code= substr( $inf['10'],0,4 );
			$phone_number= substr( $inf['10'],4);
			$mobile_code=substr( $inf['11'],0,4 );
			$mobile_number= substr( $inf['11'],4);
			

			
			if($inf[3]=="F" || $inf[3]=='f')
			{
				$gender="Femenino";
			}

			else
			{
				$gender="Masculino";
			}

		echo '<div class="row">
			<div class="col-md-10 col-md-offset-1">

				<div class="panel panel-default">
						
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			        	<div class="panel-title">
			          		Registro de Paciente
			          	</div>
			        </div>
	        
			        <div class="panel-body">	    
						<div class="row">
							<div class="col-md-11">
	   							<div class="form-group">
									<label class="control-label col-sm-2">Nombre</label>
									<div class="col-sm-4">
										<input type="text" name="patient_name" id="patient_name" class="form-control" placeholder="Nombre del Paciente" value="'.$inf[1].'" maxlength="15" minlength="3"  onkeypress="return caracteres(event)">
									</div>
							
									<label class="control-label col-sm-2">Apellido</label>
									<div class="col-sm-4">
										<input class="form-control" name="patient_lastname" id="patient_lastname"placeholder="Apellido del Paciente" type="text" value="'.$inf[2].'" maxlength="20" minlength="3"  onkeypress="return caracteres(event)">
									</div>
								</div>
								<br>

								<div class="form-group">
									<label class="control-label col-sm-2" for="TextArea">Género</label>
									<div class="col-sm-4 selectContainer" >
							            <select class="SlectBox" name="patient_gender" id="gender-select-box">
							            	<option value="" disabled selected></option>
							                <option value="F" '; if ($inf[3]=='F') echo "selected"; echo '>Femenino</option>';

							                echo '<option value="M" '; if ($inf[3]=='M') echo "selected";  echo '>Masculino</option>';

					                                 										
							            echo '</select>
					        		</div>

									<label class="control-label col-sm-2">Fecha de Nacimiento</label>

									<div class="input-append date col-sm-4"  >
						      			<input type="date" name="birthday" id="birthday" style="display: inline-block !important;" class="form-control"size="14"  placeholder="1999-10-15" onblur="fecha(event)" value="'.$inf[4].'"> 
						      					
						    		</div>
								</div>

								<div class="form-group ">
							        <label class="control-label col-sm-2" for="labelCedula">Cédula</label>
							        <div class="col-sm-4">
							        	<input type="number" class="form-control" id="idcard" name="idcard" placeholder="Cédula de Identidad" value="'.$inf[0].'" readonly> 
							        	<br>
							        </div>

							        <label for="" class="control-label col-sm-2">Estado Civil</label>
						    		<div class="col-sm-4 selectContainer">
								        <select class="SlectBox" id="status-select-box" name="maritalStatus">		            	
									        <option value="0" disabled selected></option>';
								            foreach ($m_status as $status)
								            {
					                                 echo '<option value="'.$status[0].'"'; 
					                                 										if ($status[0]==$inf[5])
					                                 										echo "selected";
					                                 echo '>'.$status[1].'</option>';
					                        }
								      echo  '</select>
						    		</div>          
							    </div>
								<br>		

								<div class="form-group">
									<label for="" class="control-label col-sm-2">Profesión / Ocupación</label>
									<div class="col-sm-4">
										<input type="text" id="ocupation" name="ocupation" placeholder="Ingrese su ocupación" class="form-control" size="28" value="'.$inf[6].'"/>
									</div>

									<label class="control-label col-sm-2" for="TextArea">Dirección de Habitación</label>
									<div class="col-sm-4">
										<textarea class="form-control" id="address" rows="3" cols="50" name="address" placeholder="Escriba aquí su dirección">'.$inf[7].'</textarea>
									</div>		
								</div>
								<br>
				
								<div class="form-group">
							        <label class="control-label col-sm-2" >Estado</label>
							        <div class="col-sm-4 selectContainer" >
							            <select class="SlectBox" id="state-select-box" name="state">
								            <option value="0" disabled selected></option>';
								            foreach ($states as $state)
								            {
					                                 echo '<option value="'.$state[0].'"'; 
					                                 										if ($state[0]==$inf[8])
					                                 										echo "selected";
					                                 echo '>'.$state[1].'</option>';
					                        }
							          
							          echo '</select>
							    	</div>
	    		
									<label class="control-label col-sm-2 ">Ciudad</label>
							        <div class="col-sm-4 selectContainer" id="cities">
										<select class="SlectBox" id="city-select-box" name="city">
							            	 <option value="Seleccione..." disabled selected></option>';

							            	  foreach ($cities as $city)
								            {
					                                 echo '<option value="'.$city[0].'"'; 
					                                 										if ($city[0]==$inf[9])
					                                 										echo "selected";
					                                 echo '>'.$city[1].'</option>';
					                        }
							          
							          echo '</select>

							       
							        </div>	
								</div>
								<br>

								<div class="form-group">
									<br>
									<label class="control-label col-sm-2">Números de Contacto</label>
								
									<div class="col-sm-2">
										<input class="form-control" placeholder="0000" type="number" name="phone_code"  id="phone_code" value="'.$phone_code.'">
										<div class="help">Local</div>
									</div>

									<div class="col-sm-2">
										<input class="form-control" placeholder="1111111" type="number" name="phone_number" id="phone_number" value="'.$phone_number.'">
										<div class="help">Number</div>
									</div>

									<div class="col-sm-2">
										<input class="form-control" placeholder="0000" type="number" name="mobile_code" id="mobile_code" value="'.$mobile_code.'">
										<div class="help">Móvil</div>
									</div>

									<div class="col-sm-2">
										<input class="form-control" placeholder="1111111" type="number" name="mobile_number" id="mobile_number" value="'.$mobile_number.'">
										<div class="help">Number</div><br>
									</div>
								</div>
								<br>

								<div class="form-group">
									<label for="" class="control-label col-sm-2">Correo Electrónico</label>
									<div class="col-sm-4">
										<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email" value="'.$inf[12].'">
									</div>

									<label for="" class="control-label col-sm-2">Referido por</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" placeholder="Ingrese referencia" name="referedBy" id="referedBy" value="'.$inf[13].'">
									</div>		
								</div>
							
	      					</div><!--Col Form-->
	      				</div> <!--Row Form-->
	        		</div><!--Panel,body-->
	      		</div><!--Panel,default-->			
			</div><!--colmd8-->
		</div><!--row-->
';
}
	
		/*<div class = "row" >
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
			echo "<td><strong>Cédula de Identidad: </strong>".$inf[0] ."</td>"."<td><strong>Nombre : </strong>".$inf[1]." ".$inf[2]."</td>";
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
		      </div>";*/
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
							echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="diabetes" hecked />';
							
							else
							echo '<input type="checkbox" class="inline-checkbox" id="" name="medical_history[]" value="diabetes" />';
							
							 
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
						    	<input type="date" placeholder="aaaa-mm-dd" class="form-control"  id="lastPeriod" name="lastPeriod"  value="'.$m_record[12].'" style="max-width:180px;" onblur="fecha(event)"/>
						    </td>


					  	<td class="field-label" colspan="2">

					  		
					  	  		<p class="page-text col-md-6">Embarazos</p>
						        <div style="display: inline-block;">
								  <input type="number" class="form-control" id="numberOfPregnancys"  name="numberOfPregnancys" min="0" max="15" value="'.$m_record[11].'"style="max-width:100px;">
						            
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

					  			<input type="text" class="form-control " placeholder="" style="max-width:550px;" id="allergies" name="allergies" value="'.$m_record[14].'"/>
					  		</td>


					  	</tr>


					</table>
					</div>
					</div>';

	}

}



if ($button==1) 
{
	echo '<div class="row" style="text-align:center;">
			<div class="col-md-4 col-md-offset-4">
			<button  class="big-btn-purple" type="submit" style="margin-top: 40px; margin-bottom: 20px;">Guardar Cambios</button>
			</div>
		  </div> </form>';
}

?>
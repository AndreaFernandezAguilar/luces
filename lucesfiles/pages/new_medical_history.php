<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session();

    require_once('../modules/class/history.class.php');
	$history = new History();
	$states = $history->getStates();
	$m_status=$history->getMaritalStatus();
?>

<body>
	<!--Header/Menu-->
	<?php 
		if ($_SESSION['id_role']==1)
		include("../modules/sections/header_manager.php");
		elseif($_SESSION['id_role']==2)
		include("../modules/sections/header_employee.php");
	?>
			
	<div class="container" id="medicalHistory">
	</div>

	<div class="container">
		 <form action="../modules/controllers/patient-controller.php" method="POST" class="form-horizontal" role="form" id="form-medical-history">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Nueva Historia</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">	
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			        	<div class="panel-title">
			          		Registro de Paciente
			          	</div>
			        </div>
	        
			        <div class="panel-body butterfly5">	    
						<div class="row">
							<div class="col-md-11">		
	   							<div class="form-group">
									<label class="control-label col-sm-2">Nombre</label>
									<div class="col-sm-4">
										<input type="text" name="patient_name" id="patient_name" class="form-control" placeholder="Nombre del Paciente" maxlength="15" minlength="2"  onkeypress="return caracteres(event)">
									</div>
							
									<label class="control-label col-sm-2">Apellido</label>
									<div class="col-sm-4">
										<input class="form-control" name="patient_lastname" id="patient_lastname" placeholder="Apellido del Paciente" type="text" maxlength="20" minlength="3" onkeypress="return caracteres(event)">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="TextArea">Género</label>
									<div class="col-sm-4 selectContainer" >
							            <select class="SlectBox" name="patient_gender" id="gender-select-box">
							            	<option value="" selected></option>
							                <option value="F">Femenino</option>
							                <option value="M">Masculino</option>
							            </select>
					        		</div>

									<label class="control-label col-sm-2">Fecha de Nacimiento</label>
									<div class="input-append date col-sm-4"  >
						      			<input type="text" name="birthday" id="birthday" style="display: inline-block !important;" class="form-control datepicker" size="14"  placeholder="1999-10-15"> 
						      					
						    		</div>
								</div>

								<div class="form-group ">
							        <label class="control-label col-sm-2" for="labelCedula">Cédula</label>
							        <div class="col-sm-4">
							        	<input type="number" class="form-control" id="idcard" name="idcard" placeholder="Cédula de Identidad" > 
							        	<br>
							        </div>

							        <label for="" class="control-label col-sm-2">Estado Civil</label>
						    		<div class="col-sm-4 selectContainer">
								        <select class="SlectBox" id="status-select-box" name="maritalStatus">		            	
									        <option value="0" disabled selected></option>
								            <?php foreach ($m_status as $status): ?>
					                                    <option value="<?php echo $status['0'] ?>"><?php echo $status['1'] ?></option>
					                        <?php endforeach ?>
								        </select>
						    		</div>          
							    </div>	

								<div class="form-group">
									<label for="" class="control-label col-sm-2">Profesión / Ocupación</label>
									<div class="col-sm-4">
										<input type="text" id="ocupation" name="ocupation" placeholder="Ingrese su ocupación" class="form-control" size="28" maxlength="70" onkeypress="return caracteres(event)"/>
									</div>
 
									<label class="control-label col-sm-2" for="address">Dirección de Habitación</label>
									<div class="col-sm-4">
										<textarea class="form-control" rows="3" cols="50" name="address" id="address" maxlength="140" minlength="3" placeholder="Escriba aquí su dirección"></textarea>
									</div>		
								</div>
								<div class="form-group">
							        <label class="control-label col-sm-2" >Estado</label>
							        <div class="col-sm-4 selectContainer" >
							            <select class="SlectBox" id="state-select-box" name="state">
								            <option value="0" selected></option>
								            <?php foreach ($states as $state): ?>
					                                    <option value="<?php echo $state['0'] ?>"><?php echo $state['1'] ?></option>
					                        <?php endforeach ?>
							            </select>
							    	</div>
	    		
									<label class="control-label col-sm-2 ">Ciudad</label>
							        <div class="col-sm-4 selectContainer" id="cities">
										<select class="SlectBox" id="city-select-box" name="city">
							            	 <option value="0" selected></option>
							            </select>
							        </div>	
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2">Números de Contacto</label>
									<div class="col-sm-2">
										<input class="form-control" placeholder="0000" type="number" name="phone_code" id="phone_code">
										<div class="help">Local</div>
									</div>
									<div class="col-sm-2">
										<input class="form-control" placeholder="1111111" type="number" name="phone_number" id="phone_number">
										<div class="help">Número</div>
									</div>

									<div class="col-sm-2">
										<!--<select name="mobile_code" id="mobile_code" class="SlectBox" style="width:100%;">
											<option value="0" selected disabled>Seleccione...</option>
											<option value="0412">0412</option>
											<option value="0414">0414</option>
											<option value="0416">0416</option>
											<option value="0424">0424</option>
											<option value="0426">0426</option>
										</select>-->
										<input class="form-control" placeholder="0000" type="number" name="mobile_code" id="mobile_code">
										<div class="help">Móvil</div>
									</div>

									<div class="col-sm-2">
										<input class="form-control" placeholder="1111111" type="number" name="mobile_number" id="mobile_number">
										<div class="help">Número</div><br>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">Correo Electrónico</label>
									<div class="col-sm-4">
										<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email">
									</div>

									<label for="" class="control-label col-sm-2">Referido por</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" placeholder="Ingrese referencia" name="referedBy" id="referedBy">
									</div>		
								</div>
	      					</div><!--Col Form-->
	      				</div> <!--Row Form-->
	        		</div><!--Panel,body-->
	      		</div><!--Panel,default-->			
			</div><!--colmd8-->
		</div><!--row-->

		<div class="row">
			<div class="page-header">
				<h4>Antecedentes personales</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<table class="table table-bordered" id="illness-record-table">
				<tr>
					 <td class="col-md-1">
					 	<input type="checkbox" class="inline-checkbox" id="diabetes" name="medical_history[]" value="diabetes"/>
					 </td>

				     <td class="field-label col-md-5">
				     	<p class="page-text">Diabetes</p>
				     </td>

				     <td class="field-label col-md-1">
				     	<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="orthodonticDevice" />
				     </td>

				    <td class="field-label col-md-5">
				    	<p class="page-text">Prótesis dental o metálicas</p>
				    </td>
			  	</tr>

			  	<tr>
			  		<td class="field-label col-md-1">
			  			<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="hypertensive" />
			  		</td>

				    <td class="field-label col-md-5">
				    	<p class="page-text">Hipertensión</p>
				    </td>

				    <td class="field-label col-md-1">
				    	<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="sunBlemishes"/>
				    </td>

				    <td class="field-label col-md-5">
				    	<p class="page-text">Manchas en la piel</p>
				    </td>
			  	</tr>

			  	<tr>
				   <td class="field-label col-md-1">
				   		<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="keloids" />
				   </td>

				   <td class="field-label col-md-5">
				   		<p class="page-text">Queloides</p>
				   </td>

				   <td class="field-label col-md-1">
				   		<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="tan" />
				   </td>

				   <td class="field-label col-md-5">
				   		<p class="page-text">Bronceado</p>
				   </td>

			  	</tr>

			  	<tr>
 				  <td class="field-label col-md-1">
 				  	<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="cancer" />
 				  </td>

				  <td class="field-label col-md-5">
				  	<p class="page-text">Cáncer </p>
				  </td>

				   <td class="field-label col-md-1">
				   	<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="sunReactions" />
				   </td>

				  <td class="field-label col-md-5">
				  	<p class="page-text">Reacciones al Sol</p>
				  </td>

			  	</tr>
			  	<tr>
			  		<td class="field-label col-md-1">
			  			<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]"  value="arthritis"/>
			  		</td>
			  	    <td class="field-label col-md-5">
			  	    	<p class="page-text">Artritis</p>
			  	    </td>
			  	    <td class="field-label col-md-1">
			  	    	<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="lupus"/>
			  	    </td>
				   	<td class="field-label col-md-5">
				   	<p class="page-text">Lupus</p>
				   </td>     
			  	</tr>

			  	<tr>
 				  <td class="field-label col-md-1">
 				  	<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="smoking"/>
 				  </td>
				  <td class="field-label col-md-5">
				  	<p class="page-text">Fumador (a) </p>
				  </td>
				   <td class="field-label col-md-1">
				   	<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="contraceptiveOrHormones"/>
				   </td>
				  <td class="field-label col-md-5">
				  	<p class="page-text">Hormonas y/o Anticonceptivos</p>
				  </td>
			  	</tr>
			 	<tr>
		  		    <td class="field-label col-md-1">
		  		    	<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="pacemaker" />
		  		    </td>

				    <td class="field-label col-md-5">
				    	<p class="page-text">Marcapaso</p>
				    </td>

				    <td class="field-label col-md-1">
				    	<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="workout" />
				    </td>

				    <td class="field-label col-md-5">
				    	<p class="page-text">Ejercicios</p>
				    </td>
			  	</tr>

				<tr>	
				    <td class="field-label col-md-1">
				    	<input type="checkbox" class="inline-checkbox" id="medical_history[]" name="medical_history[]" value="kidneyFailure"/>
				    </td>
				    <td class="field-label col-md-5">
				    	<p class="page-text">Insuficiencia Renal</p>
				    </td>
					<td class="field-label col-md-1">
			  			<input type="checkbox" class="inline-checkbox" id="medical_history[]"  name="medical_history[]" value="currentlyPregnant"/>
			  		</td>
				     <td class="field-label col-md-5">
				     	<p class="page-text">Actualmente embarazada</p>
				     </td> 		
			  	</tr>

			  	<tr>	
			  		<td class="field-label" colspan="2">
				    	<p class="page-text col-md-6" style="margin-left:5px;">Último Período</p>
				    	<input type="text" placeholder="2015-09-25" class="form-control datepicker" id="lastPeriod" name="lastPeriod" style="max-width:120px;" onblur="fecha(event);">
				    </td>

			  	  	<td class="field-label" colspan="2">
			  	  		<p class="page-text col-md-6">No. de Embarazos</p>
				        <div style="display: inline-block;">
				            <input type="number" class="form-control" id="numberOfPregnancys"  name="numberOfPregnancys" min="0" max="15" style="max-width:100px;">
				              
				        </div>
			        </td>       
			  	</tr>

			  	<tr>
			  		<td class="field-label col-md-1">
			  			<input type="checkbox" class="inline-checkbox" id="" name="" />
			  		</td>
			  		<td class="field-label" colspan="4">
			  			<p class="page-text col-md-2">Alergias</p>
			  			<input type="text" class="form-control" placeholder="" style="max-width:550px;" id="allergies" name="allergies" />
			  		</td>
			  	</tr>
			</table>
		</div><!--colmd8-->
		</div><!--row-->

		<div class="row">
			<div id="legal-disclaimer">
				<span class="page-text">
					<input type="checkbox" class="inline-checkbox" name = "legal-text" id = "legal-text"/>
					Doy fe que todos los datos aquí suministrados, son correctos y exactos, 
					por lo cual asumo la responsabilidad en caso de omisión.<br>
					Yo <span id="name-span"></span> <span id="lastName-span"></span>, titular de la cédula de identidad No. <span id="id-span"></span>,		    
					declaro que me ha sido explicado en su totalidad los tratamientos  a los cuales deseo 
					someterme, por dicha razón entiendo las naturaleza y consecuencias del mismo; 
					asumiendo así, los riesgos eventuales que puedan sobrevenir, entre ellos: 
					inflamación, ardor, rubor, hipo e hiper pigmentaciones y erosión de la piel.
				</span>
			</div>	
		</div>
		<div class="row" style="text-align:center;">
			<div class="col-md-4 col-md-offset-4">
				<button  class="big-btn-purple" type="submit" style="margin-top: 40px; margin-bottom: 50px;">Guardar Historia</button>
			</div>
		</div>
	</form>

	</div>


	<div class="container" id="medicalHistory2" style="margin-bottom: 20px;">
	</div>
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/new_medical_history.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/history/new_medical_history.js"></script>	
</div>
</body>
</html>
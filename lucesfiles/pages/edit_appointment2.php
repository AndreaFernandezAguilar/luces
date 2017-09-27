<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);

    include("../modules/sections/head.php");
	require_once('../modules/class/user.class.php');
	require_once('../modules/class/treatment.class.php');
	$user = new User();
	$branches = $user->getBranches();
	$roles=$user->getRoles();
	$treat= new Treatment();
	$treatments=$treat->getTreatmentsList();
?>

<style type="text/css">
	td.fc-day.fc-past 
	{
    	background-color: #EEEEEE;
    }
</style>
		
<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>
	<!--Container Principal-->
	<div class="container" id="principal">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Editar Cita</h4>
			</div>
		</div>
		<div class="row" id="rowPanel">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
				    <div class="panel-heading clearfix">
				        <i class="icon-calendar"></i>
				        <h3 class="panel-title">Datos de la Cita</h3>
				    </div>
		        
				    <div class="panel-body">
				        <form class="form-horizontal" action="" method="POST" role="form" id="form-list-appointment">
					    	<div class="form-group">
					            <label class="control-label col-sm-3 col-sm-offset-2">C.I del Paciente</label>
								<div class="col-sm-4">
									<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del paciente" type="number" maxlength="10" minlength="7"  style="" required>
									<div id="validate-identityCard"></div>  
					            </div>
					        </div>
							<div class="form-group">
								<label class="control-label col-sm-3 col-sm-offset-2">Sucursal</label>
								<div class="col-sm-4 selectContainer" >
									<select class="SlectBox" id="branch-select-box" name="branch" id="branch">
										<option value="0" selected>Seleccione...</option>
										<?php foreach ($branches as $branch): ?>
								            <option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
								        <?php endforeach ?> 
									</select>
								</div>
							</div>							
							<div class="form-group">
					            <label class="control-label col-sm-3 col-sm-offset-2" for="labelTreatment">Tratamiento</label>
					            <div class="col-sm-4">
									<select class="SlectBox" name="treatment-select-box" id="treatment-select-box">
										<option value="0" selected>Seleccione...</option>
										<?php foreach ($treatments as $treatment): ?>
										<option value="<?php echo $treatment['0'] ?>"><?php echo $treatment['1'] ?></option>
										<?php endforeach ?> 
									</select>
								</div>        	    
					        </div>
					          
					        <!--<div class="form-group">
					            <label class="control-label col-sm-3 col-sm-offset-2" for="labelAppointment">Fecha de la Cita</label>
					            <div class="col-sm-4">
					            	<input type="" class="form-control datepicker" name="appoitment" id="appointment" required>
					            </div>
					        </div> -->
					        <!--<div class="form-group">
					            <label class="control-label col-sm-3 col-sm-offset-2" for="labelTreatment">Acción a realizar</label>
					            <div class="col-sm-4">
									<select class="SlectBox" name="action-select-box" id="action-select-box">
										<option value="0" selected>Seleccione...</option>
										<option value="1">Modificar estatus: Confirmada</option>
										<option value="2">Modificar estatus: Atendida</option>
										<option value="3">Modificar fecha</option>
									</select>
								</div>        	    
					        </div>-->
								
							<div class="form-group">
	 							<div class="col-sm-4 col-sm-offset-5">
					              	<button class="medium-btn-purple " type="submit">Siguiente</button>
					            </div>
							</div>
			 		  	</form> 
		        	</div>
		      	</div>
			</div>
		</div>	
		<div class="row" id="results">		
		</div>

		<div class="row" style="margin-top:50px;">
			<div class="col-md-4 col-md-offset-4" id="saveChanges">
			</div>
		</div>
	</div>
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/edit_appointment.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/appointment/edit_appointment2.js"></script>		
</body>
</html>
<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);

	require_once('../modules/class/user.class.php');
	require_once('../modules/class/treatment.class.php');
	$user = new User();
	$branches = $user->getBranches();
	$roles=$user->getRoles();
	$treat= new Treatment();
	$treatments=$treat->getTreatmentsList();
?>

<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>

	<!--Container Principal-->
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Eliminar Cita</h4>
			</div>
		</div>
		<div class="row" id="rowPanel">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			        	<div class="panel-title">
					       	<i class="glyphicon glyphicon-edit pull-right"></i>
					        <h4>Datos de la Cita</h4>
			          	</div>
			        </div>
			        <div class="panel-body">
			          	<form class="form-horizontal" action="" method="POST" role="form" id="form-delete-appointment">
				            <div class="form-group space-top2">
				            	<label class="control-label col-sm-3 col-sm-offset-2">C.I del Paciente</label>
								<div class="col-sm-4">
									<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del paciente" type="number" maxlength="10" minlength="7"  style="" required>
										<div id="validate-identityCard"></div>  
				              	</div>
				            </div>
							<div class="form-group space-top2">
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
							<div class="form-group space-top2">
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
				            <div class="form-group space-top2">
				            	<label class="control-label col-sm-3 col-sm-offset-2" for="labelAppointment">Fecha de la Cita</label>
				            	<div class="col-sm-4">
				            		<input type="" class="form-control datepicker" name="appointmentDate" id="appointmentDate" required>
				            	</div>
				            </div>
							<div class="form-group space-top2">
 								<div class="col-sm-4 col-sm-offset-5">
				              		<button type="submit" class="medium-btn-purple"  id="delete">Siguiente</button>
				              	</div>
							</div>
		 		  	  	</form>
	        		</div>
	      		</div>
			</div>
		</div>
		<div class="row" id="results">
		</div>
	</div>
	<!--Observations and Suggestions-->
	<?php 
		include("../modules/views/observations_and_suggestions/delete_appointment.html");
	?>	
	<!--Footer-->
	<?php 
		include("../modules/sections/footer.php");
	?>		
	<!--Scripts-->
	<script type="text/javascript" src="../js/delete_appointment.js"></script>				
</body>
</html>
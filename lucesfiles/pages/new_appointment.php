<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session();
    require_once('../modules/class/user.class.php');
	require_once('../modules/class/treatment.class.php');
	$user = new User();
	$branches = $user->getBranches();
	$roles=$user->getRoles();
	$treat= new Treatment();
	$treatments=$treat->getTreatmentsList();
?>


<body>
	<link rel="stylesheet" type="text/css" href="../css/new_appointment.css">
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>
	<!--Main Container-->
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Nueva Cita</h4>
			</div>
		</div>
		<form method="POST" class="form-horizontal" id="form-new-appointment">
		<div class="row">	
			<div class="col-md-2">
				<div class="panel panel-default">
				 	<div class="panel-heading">
				    	<h3 class="panel-title">Tiempo estimado</h3>
				 	</div>
				  	<div class="panel-body" id="suggestedTimePanel">
				  	</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                        	<i class="glyphicon glyphicon-edit pull-right"></i>
                            <h4>Registro de Cita</h4>
                        </div>
                    </div>
                    <div class="panel-body">	    
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">C.I del Paciente</label>
									<div class="col-sm-5">
										<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del paciente" type="number" maxlength="10" minlength="7"  style="width:250px;" required>
										<div id="validate-identityCard"></div>  
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">Sucursal</label>
									<div class="col-sm-6 selectContainer" >
									    <select class="SlectBox" id="branch-select-box" name="branch">
										    <option value="0" selected>Seleccione...</option>
										    <?php foreach ($branches as $branch): ?>
							                <option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
							                <?php endforeach ?> 
									    </select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">Tipo de cita</label>
									<div class="col-sm-6 selectContainer" >
									    <select class="SlectBox" id="aType-select-box" name="aType-select-box">
										    <option value="0" selected>Seleccione...</option>
										    <option value="1">Pre-pago</option>
										    <option value="2">Post-pago</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">Tratamiento</label>
									<div class="col-sm-7 selectContainer" id="prepaid_treatments">
									   	<select class="SlectBox" name="treatment-select-box" id="treatment-select-box">
											<option value="0" selected>Seleccione...</option>
									   	</select>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">Área</label>
									<div multiple="multiple" class="col-sm-6 selectContainer" id="list_bodyareas">
										<select class="SlectBox" id="bodyarea" name="bodyarea">
										    <option value="0" selected>Seleccione...</option>
										</select>
									</div>
								</div>
								<br>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-6">
										<button type="submit" class="medium-btn-purple">Calendario</button>
									</div>
								</div>
							</div> <!--Col Panel-->
						</div> <!--Row Panel-->
					</div> <!--Panel Body-->
				</div>	<!--Panel-->
			</div> <!--Col-->		
		</div>	<!--Row-->  
	</div><!--container-->
	<div class="container" id="container2">	
		<div class="row" id="rowPanels">
			<div class="col-md-4">
			</div>
		</div>
		<div class="row" >
			<div class="col-md-2" id="external-events" style="">
			</div>
			<div class="col-md-10" id="rowCalendar">		
			</div>	
		</div>
		</form>
		<div class="row" style="margin-top:50px;">
			<div class="col-md-4 col-md-offset-6" id="colForm2">
			</div>
		</div>
	</div>
	<div class="container">
		<div id="newAppointment">	
		</div>
	</div> <!--container-->
	
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/new_appointment.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/appointment/new_appointment.js"></script>	
</body>
</html>
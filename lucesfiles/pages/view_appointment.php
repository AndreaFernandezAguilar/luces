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
	<div class="container">
		<div class="row">
			<div class="page-header"><br><br>
				<h4>Consultar Cita(s)</h4>
			</div>
		</div>
		<br>
		<div class="row" id="rowPanel1">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			          <h3 class="panel-title">Consulta</h3>
			        </div>
				    <div class="panel-body">
				        <form class="form-horizontal" action="" method="POST" role="form" id="form-edit-appointment">
				        	<div class="form-group">
								<label class="control-label col-sm-3 col-sm-offset-2">Tipo de consulta</label>
								<div class="col-sm-4 selectContainer" >
									<select class="SlectBox" id="type-select-box" name="type-select-box">
										<option value="0" selected>Seleccione...</option>
										<option value="1">Por Paciente y Tratamiento</option>
										<option value="2">Por Tratamiento</option>			       	   
									</select>
								</div>
							</div>	
				        </form>
				    </div>
				</div>
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
			          	<form class="form-horizontal" action="" method="POST" role="form" id="form-view-appointment">
			          		<br>
							<div class="form-group" style="display:none;" id="form_id">
							</div>
							<br>
							<div class="form-group" style="display:none;" id="form_treatment">
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
							<br>
							<div class="form-group" style="display:none;" id="form_branch">
								<label class="control-label col-sm-3 col-sm-offset-2">Sucursal</label>
								<div class="col-sm-4 selectContainer">
									<select class="SlectBox" id="branch-select-box" name="branch" id="branch">
										<option value="0" selected>Seleccione...</option>
										<?php foreach ($branches as $branch): ?>
										<option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
										<?php endforeach ?> 
									</select>
								</div>
							</div>
							<div class="form-group" style="display:none;" id="form_button">
 								<div class="col-sm-4 col-sm-offset-5">
									<button class="medium-btn-purple " type="submit">Consultar</button>
								</div>
							</div>
		 		  	  	</form>	  	 
	        		</div><!--Panel,body-->
	      		</div><!--Panel,default-->
			</div><!--colmd8-->
		</div><!--row-->
		<div class="row" id="rowCalendar">
			<div id='calendar' class="space-top4"></div>
		</div>
	</div> <!--container principal-->
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/view_appointment.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/appointment/view_appointment.js"></script>
</body>
</html>
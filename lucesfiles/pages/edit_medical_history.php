<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);

    require_once('../modules/class/history.class.php');
	$history = new History();
	$states = $history->getStates();
	$m_status=$history->getMaritalStatus();
?>
<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>
	<div class = "container">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Modificar Historia Médica</h4>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			          <h3 class="panel-title">Buscar Historia Médica</h3>
			        </div>
			        <div class="panel-body">
			          <form class="form-horizontal" action="../modules/controllers/show_medical_history-controller.php" method="POST" role="form" id="form-show-history">			    
				            <div class="form-group">
				              <label class="control-label col-sm-4" for="labelCedula">C.I del Paciente</label>
				              <div class="col-sm-4">
				              	<input type="number" class="form-control" id="identityCard" name="identityCard" placeholder="Introduzca Cédula de Identidad" required/> 
				              </div>
				              <div class="col-sm-4">
				              	<button class="medium-btn-purple " type="submit">Buscar Paciente</button>
				              </div>
				            </div>
		 		  	  </form>
	        		</div>
	      		</div>
			</div>
		</div>
	</div>

	<div class="container" id="medicalHistoryChanged">
	</div>

	<div class="container butterfly2" id="medicalHistory">
	</div>	

	<div class="container" id="medicalHistoryChanged2">
	</div>

	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/edit_medical_history.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/history/edit_medical_history.js"></script>
</body>
</html>
<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session();
?>
<body>
	<!--Header/Menu-->
	<?php 
		if ($_SESSION['id_role']==1)
		include("../modules/sections/header_manager.php");
			
		elseif($_SESSION['id_role']==2)
		include("../modules/sections/header_employee.php");
	?>
	<div class="container">
		<div class="row">
			<div class="page-header"><br><br>
				<h4>Historia Médica</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			          <h3 class="panel-title">Consultar Historia</h3>
			        </div>
			        <div class="panel-body">
			        	<form class="form-horizontal" action="../modules/controllers/show_medical_history-controller.php" method="POST" role="form" id="form-show-history">
				            <div class="form-group">
				              <label class="control-label col-sm-4" for="labelCedula">C.I del Paciente</label>
				              <div class="col-sm-4">
				              	<input type="number" class="form-control" id="identityCard" name="identityCard" placeholder="Introduzca Cédula de Identidad" /> 
				              </div>
				              <div class="col-sm-4">
				              	<button class="medium-btn-purple " type="submit">Buscar Paciente</button>
				              </div>
				             </div>
		 		  		</form>
	        		</div><!--Panel,body-->
	      		</div><!--Panel,default-->
			</div><!--colmd8-->
		</div><!--row-->
	</div><!--Container-->	

	<div class="container butterfly2" id="medicalHistory">
	</div>	
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/view_medical_history.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/history/view_medical_history.js"></script>
</body>
</html>
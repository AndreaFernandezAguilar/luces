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
<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>
	<!--Main Container-->
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Editar Venta</h4>
			</div>
		</div>
		<div class="row" id="rowPanel">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			          <h3 class="panel-title">Datos de la Venta</h3>
			        </div>
			        <div class="panel-body">
			          	<form class="form-horizontal" action="" method="POST" role="form" id="form-sales-list">
			          		<div class="form-group">
								<label class="control-label col-sm-3 col-sm-offset-2">Fecha de Pago</label>
								<div class="col-sm-5">
									<input class="form-control" name="dateTimeCreation" id="dateTimeCreation" placeholder="Fecha de pago" type="text">
								</div>
							</div>
			          		<br>
							<div class="form-group">
								<label class="control-label col-sm-3 col-sm-offset-2">C.I del Cliente</label>
								<div class="col-sm-5">
									<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del cliente" type="number" maxlength="10" minlength="7">
									<div id="validate-identityCard"></div>  
								</div>
							</div>
							<br>
							<div class="form-group" style="" id="form_treatment">
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
							<div class="form-group" style="" id="form_branch">
								<label class="control-label col-sm-3 col-sm-offset-2">Sucursal</label>
								<div class="col-sm-4 selectContainer">
									<select class="SlectBox" id="branch" name="branch">
										<option value="0" selected>Seleccione...</option>
										<?php foreach ($branches as $branch): ?>
										<option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
										<?php endforeach ?> 
									</select>
								</div>
							</div>
							<div class="form-group" style="" id="form_button">
 								<div class="col-sm-4 col-sm-offset-5">
									<button class="medium-btn-purple " type="submit">Consultar</button>
								</div>
							</div>
		 		  	  	</form> 		  	 
	        		</div>
	      		</div>
			</div>
		</div>
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Lista de ventas</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			   <table class="table table-bordered formulario table2" >
				   <thead>
				   		<tr>
							<th>Fecha de Pago</th>
							<th>Cliente</th>
							<th>Sucursal</th>
							<th>Detalles</th>
					  	</tr>
				   </thead>
				   <tbody id="sales_list">
				   </tbody>
				</table>
			</div>
		</div>	
	</div>
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/list_sales.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/sale/list_sales.js"></script>		
</body>
</html>
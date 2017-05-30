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

	<!--Main Container-->
	<div class="container">
		<div class="row">
				<div class="page-header"><br><br>
					<h4>Nueva Venta</h4>
				</div>
		</div>
		<form method="POST" class="form-horizontal" id="form-new-sale">
		<div class="row">			
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="glyphicon glyphicon-edit pull-right"></i>
                            <h4>Registro de Venta</h4>
                        </div>
                    </div>
                    <div class="panel-body">	    
						<div class="row">
							<div class="col-md-11">
	   							<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">No. de Factura</label>
									<div class="col-sm-5">
										<input type="text" name="receiptNumber" id="receiptNumber" class="form-control" placeholder="Ingrese número de factura"required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">C.I del Cliente</label>
									<div class="col-sm-5">
										<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del cliente" type="number" maxlength="10" minlength="7"  required>
										<div id="validate-identityCard"></div>  
									</div>
								</div>	
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2" >Sucursal</label>
							        <div class="col-sm-5 selectContainer" >
							            <select class="SlectBox" id="branch-select-box" name="branch" id="branch">
								            <option value="0" selected>Seleccione...</option>
								       	    <?php foreach ($branches as $branch): ?>
					                            <option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
					                        <?php endforeach ?> 
							            </select>
							    	</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>			    
		<div class="row">			
			<div class="col-md-12">
				<div class="panel panel-default" style="margin-bottom:70px;">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="glyphicon glyphicon-edit pull-right"></i>
                            <h4> Agregar Tratamiento</h4>
                        </div>
                    </div>
                    <div class="panel-body">	    
						<div class="row">
							<div class="col-md-11">		
								<div class="form-group">
									<label class="control-label col-md-2">Tratamiento</label>
									<div class="col-md-3 selectContainer" >
									    <select class="SlectBox" name="treatment-select-box" id="treatment-select-box">
										    <option value="" selected>Seleccione...</option>
										    <?php foreach ($treatments as $treatment): ?>
							                <option value="<?php echo $treatment['0'] ?>"><?php echo $treatment['1'] ?></option>
							                <?php endforeach ?> 
									    </select>
									</div>
									<label class="control-label col-md-1 ">Área</label>
								    <div class="col-md-3 selectContainer" id="list_bodyareas">
										<select class="SlectBox" id="bodyarea-select-box" name="bodyarea-select-box">
								            <option value="0" selected>Seleccione...</option>
								        </select>
								    </div>
								    <label class="control-label col-md-1">Cantidad</label>
									<div class="col-md-1">
										<input type="number" name="numberOfTreatments" id="numberOfTreatments" class="form-control" min="1">
									</div>
									<div class="col-md-1">
										<a id="addField" class="btn btn-circle" href="#">
										<span class="glyphicon glyphicon-plus"></span></a>
									</div>	
								</div> 
                            </div> <!-- col-panel-->
                        </div> <!--row-panel-->		
                   	</div><!--panel-body-->
                </div><!--panel-default-->
			</div>
		</div>
		<div class="row">
			<div class="page-header"><br><br>
				<h4>Tratamientos a Registrar</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			   <table class="table table-bordered formulario table2" id="treatmentsTable" name="treatmentsTable">
					<tr>
						<th>Tratamiento</th>
					    <th>Área del Cuerpo</th>
					    <th>Cantidad</th>
				  	</tr>
				</table>
			</div>
		</div>	
		<div class="row" style="text-align:center;" id="buttonNewSale">		
		</div>
		
		</form>
		<div id="newSale">	
		</div>
	</div> <!--container principal-->
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/new_sale.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/sale/new_sale.js"></script>
</body>
</html>
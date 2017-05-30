<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);

    require_once('../modules/class/user.class.php');
	require_once('../modules/class/treatment.class.php');
	$user = new User();
	$branches = $user->getBranches();
	//$roles=$user->getRoles();
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
			<div class="page-header"><br><br>
				<h4 class="space-top4">Nueva Promoción</h4>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="glyphicon glyphicon-edit pull-right"></i>
                            <h4>Registro de Promoción</h4>
                        </div>
                    </div>

                    <div class="panel-body butterfly5">	    
						<div class="row">
							<div class="col-md-11">
								<form method="POST" class="form-horizontal" id="form-new-discount">
								<div class="form-group">
									<label class="control-label col-sm-2">Tratamiento</label>
									<div class="col-sm-4">
										<select class="SlectBox" name="treatment" id="treatment">
										    <option value="0" selected>Seleccione...</option>
										    <?php foreach ($treatments as $treatment): ?>
							               	<option value="<?php echo $treatment['0'] ?>"><?php echo $treatment['1'] ?></option>
							                <?php endforeach ?> 
									    </select>
									</div>
									<label class="control-label col-sm-2">Descuento</label>
									<div class="col-sm-4">
										<input type="number" name="percentage" id="percentage" class="form-control" min="1" max="100" required>
									</div>
								</div>
	   							<div class="form-group">
									<label class="control-label col-sm-2">Desde</label>
									<div class="col-sm-4">
										<input type="date" name="beginDate" id="beginDate" class="form-control" required>
									</div>
									<label class="control-label col-sm-2">Hasta</label>
									<div class="col-sm-4">
										<input class="form-control" name="endDate" id="endDate"  type="date" required>
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-sm-2" for="address">Condiciones</label>
									<div class="col-sm-4">
										<textarea class="form-control" rows="3" cols="50" name="conditions" id="conditions" maxlength="140" minlength="3" placeholder="Condiciones de la promoción"></textarea>
									</div>
								</div>
                            	<div class="form-group" style="margin-bottom:50px;">
	                                <label></label>
	                                <div class="col-sm-6 col-sm-offset-5">
		                                <button type="submit" class="medium-btn-purple">Registrar</button>
										<button type="reset" class="medium-btn-purple">Borrar</button>
	                                </div>
                                </div>  
                            </form>
                       	</div> <!-- col-form-->
                    </div> <!--row-form-->		
                </div><!--panel-body-->
            </div><!--panel-default-->
		</div>
	</div>
		<div id="newDiscount">	
		</div>
	</div> <!--container principal-->
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/new_discount.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/discount/new_discount.js"></script>	
</body>
</html>
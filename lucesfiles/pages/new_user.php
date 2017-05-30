<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);
    require_once('../modules/class/user.class.php');
	$user = new User();
	$branches = $user->getBranches();
	$roles=$user->getRoles();
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
				<h4 class="space-top4">Nuevo Usuario</h4>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="glyphicon glyphicon-edit pull-right"></i>
                            <h4>Registro de Usuario</h4>
                        </div>
                    </div>
                    <div class="panel-body butterfly5">	    
						<div class="row">
							<div class="col-md-11">
								<form method="POST" class="form-horizontal" id="form-new-user">
								<div class="form-group">
									<label class="control-label col-sm-2">Nombre</label>
									<div class="col-sm-4">
										<input type="text" name="name" id="name" class="form-control" placeholder="Nombre" maxlength="15" minlength="3"  onkeypress="return caracteres(event)" required>
									</div>
									<label class="control-label col-sm-2">Apellido</label>
									<div class="col-sm-4">
										<input class="form-control" name="lastname" id="lastname"placeholder="Apellido" type="text" maxlength="20" minlength="3" onkeypress="return caracteres(event)" required>
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">Cédula de Identidad</label>
									<div class="col-sm-4">
										<input type="number" class="form-control" placeholder="Cédula de identidad del usuario" name="identityCard" id="identityCard" required>
									</div>	

									<label for="" class="control-label col-sm-2">Correo Electrónico</label>
									<div class="col-sm-4">
										<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email" required>
									</div>	
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2">Nombre de Usuario</label>
									<div class="col-sm-4">
										<input type="text" name="username" id="username" class="form-control" placeholder="Ingrese un nombre de usuario" maxlength="15" minlength="5" required>
										<div id="validateUsername"></div>
									</div>
									<label class="control-label col-sm-2">Clave de Usuario</label>
									<div class="col-sm-4">
										<input class="form-control" name="password" id="password" placeholder="Ingrese una clave para el usuario" type="password" maxlength="20" minlength="3" required>
									</div>
								</div>
								<div class="col-sm-4 col-sm-offset-2" id="validateUsername"></div>
								<br>
								<div class="form-group">
							        <label class="control-label col-sm-2" >Sucursal</label>
							        <div class="col-sm-4 selectContainer" >
							            <select class="SlectBox" id="branch-select-box" name="branch" id="branch">
								           	<option value="0" selected>Seleccione...</option>
								       	    <?php foreach ($branches as $branch): ?>
					                            <option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
					                        <?php endforeach ?> 
							            </select>
							    	</div>
									<label class="control-label col-sm-2 ">Rol de Usuario</label>
							        <div class="col-sm-4 selectContainer">
										<select class="SlectBox" id="roles-select-box" name="role" id="role">
							            	<option value="0" selected>Seleccione...</option>
							            	<?php foreach ($roles as $role): ?>
					                            <option value="<?php echo $role['0'] ?>"><?php echo $role['1'] ?></option>
					                        <?php endforeach ?> 
							            </select>
							        </div>	
								</div>
                        			<div class="form-group" style="margin-bottom:50px;">
                                    	<label></label>
                                   		<div class="col-sm-6 col-sm-offset-5">
	                                        <button type="submit" class="medium-btn-purple">
	                                           Registrar
	                                        </button>
	                                        <button type="reset" class="medium-btn-purple">
	                                         Borrar
	                                        </button>
                                    	</div>
                                	</div>
                                	<br>    
                        		</form>
                        	</div> <!-- col-form-->
                        </div> <!--row-form-->		
                   	</div><!--panel-body-->
                </div><!--panel-default-->
			</div>
		</div>
		<div id="newUser">	
		</div>
	</div> <!--container principal-->
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/new_user.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/user/new_user.js"></script>	
</body>
</html>
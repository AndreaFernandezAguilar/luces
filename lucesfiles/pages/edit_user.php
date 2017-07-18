<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);
    require_once ('../modules/class/user.class.php');
    $id_branch=$_SESSION['id_branch'];
    $u=new User();
    $user=$u->getUser($_GET['idUser'],$id_branch);
    $branches = $u->getBranches();
    $roles=$u->getRoles();
 ?>

<script type="text/javascript">
	$(document).ready( function()
	{	

		
	});
</script>
<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>

	<!--Container Principal-->
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Editar Usuario</h4>
			</div>
		</div>
		<div class="row">			
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                           	<i class="glyphicon glyphicon-edit pull-right"></i>
                            <h4>Registro de Usuarios</h4>
                        </div>
                    </div>

                    <div class="panel-body butterfly5">	    
						<div class="row">
							<div class="col-md-11">
								<form method="POST" class="form-horizontal" id="form-edit-user">
								<input type="hidden" name="" value="<?php echo $_GET['idUser']; ?>" id="idUser" name="idUser">	
	   							<div class="form-group">
									<label class="control-label col-sm-2">Nombre</label>
									<div class="col-sm-4">
										<input type="text" name="name" id="name" class="form-control" placeholder="Nombre" maxlength="15" minlength="3" readonly onkeypress="return caracteres(event)" value="<?php echo $user[1]; ?>">
									</div>
									<label class="control-label col-sm-2">Apellido</label>
									<div class="col-sm-4">
										<input class="form-control" name="lastname" id="lastname"placeholder="Apellido" type="text" readonly maxlength="20" minlength="3" onkeypress="return caracteres(event)" value="<?php echo $user[2]; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="control-label col-sm-2">Cédula de Identidad</label>
									<div class="col-sm-4">
										<input type="number" class="form-control" placeholder="Cédula de identidad del usuario" name="identityCard" id="identityCard" value="<?php echo $user[3]; ?>" readonly>
									</div>	
									<label for="" class="control-label col-sm-2">Correo Electrónico</label>
									<div class="col-sm-4">
										<input type="email" class="form-control" placeholder="example@example.com" name="email" id="email" value="<?php echo $user[4]; ?>" required>
									</div>	
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2">Nombre de Usuario</label>
									<div class="col-sm-4">
										<input type="text" name="username" id="username" class="form-control" placeholder="Ingrese un nombre de usuario" maxlength="15" minlength="3" value="<?php echo $user[5];?>" required>
									</div>
									<label class="control-label col-sm-2">Clave de Usuario</label>
									<div class="col-sm-4">
										<input class="form-control" name="password" id="password" placeholder="Ingrese una clave para el usuario" type="password" maxlength="20" minlength="3" value="" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" >Sucursal</label>
									<div class="col-sm-4 selectContainer" >
									    <select class="SlectBox" id="branch-select-box" name="branch" id="branch">
										    <option value="0" selected>Seleccione...</option>
										    <?php foreach ($branches as $branch): ?>
							                <option value="<?php echo $branch['0'] ?>" <?php if($branch[0]==$user[7]) echo "selected"; ?>><?php echo $branch['1'] ?></option>
							              	<?php endforeach ?> 
									    </select>
									</div>
			    		
									<label class="control-label col-sm-2 ">Rol de Usuario</label>
									    <div class="col-sm-4 selectContainer">
											<select class="SlectBox" id="roles-select-box" name="role" id="role">
									            <option value="0" selected>Seleccione...</option>
									            <?php foreach ($roles as $role): ?>
							                    <option value="<?php echo $role['0'] ?>" <?php if($role[0]==$user[8]) echo "selected"; ?>><?php echo $role['1'] ?></option>
							                    <?php endforeach ?> 
									        </select>
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
                            	</div> 
                            </div>	
                    	</div>
                </div>
			</div>
		</div>
		<div id="editUser">	
		</div>
	</div> <!--container principal-->
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/edit_user.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/user/edit_user.js"></script>
</body>
</html>
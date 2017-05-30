<head>
	<?php 
		include("../modules/sections/head.php");

				/*require_once ('../modules/class/connection.class.php');
		        $conect = new Connection();
		        $user_name=$_SESSION['name'];
		            
		        if (!isset($_SESSION['id_role']) || !isset($_SESSION['id_user']))
		        {    
		               header('Location: ../../index.php?error=true');
		        }


		        elseif ($_SESSION['id_role']!=1)  
		        {        
		           header('Location: ../../index.php?error=true');
		        }

				
				else
				{
					include("../modules/sections/head.php");
					require_once('../modules/class/user.class.php');
					$user = new User();
					$branches = $user->getBranches();
					$roles=$user->getRoles();
					
				}*/
	 ?>


	 <script type="text/javascript">

	 	function caracteres(e) 
		{
    		tecla = (document.all) ? e.keyCode : e.which;

 			if (tecla==8 || tecla==37 || tecla<=38 || tecla==39 || tecla<=40) return true;
    			patron =/[A-Za-z]/;
    			te = String.fromCharCode(tecla);

    		return patron.test(te);
		}

     	$(document).ready(function()
     	{
     		$('.SlectBox').SumoSelect();

     		$('#username').blur(function(evento){

     			var username=$("#username").val();

     			//AJAX
    			$.ajax(
    				{
    					url: "../modules/controllers/user-username-controller.php",
    					type:"post",
    					data:
    					{	
    				
							"username":username
							
    					},

                    	success: function(oper)
                    	{	  
                   		   $("#validateUsername").html(oper);  
                   		   
                    	},

                    	error: function(error)
                    	{
                    	   alert(error);
                    	}

		            }); //end ajax

     		});
     
     		$("#form-new-user").submit(function(e)
		  	{
		  		e.preventDefault();

		  		if ($('select[name=branch]').val() ==='0')
				{
					alert('Seleccione la Sucursal');
					return false;
					
				}

				if ($('select[name=role]').val() ==='0')
				{
					alert('Seleccione el Rol del Usuario');
					return false;
				}


		  		var identityCard = $("#identityCard").val();
				var name=$("#name").val();
				var lastname=$("#lastname").val();
				var email=$("#email").val();
				var username=$("#username").val();
				var password=$("#password").val();
				var role=$("#roles-select-box").val();
				var branch=$("#branch-select-box").val();


     			//AJAX
    			$.ajax(
    				{
    					url: "../modules/controllers/user-controller.php",
    					type:"post",
    					data:
    					{	
    						
                            "identityCard":identityCard,
                            "name":name,
                            "lastname":lastname,
							"email":email,
							"username":username,
							"password":password,
							"role":role,
							"branch":branch
    					},

                    	success: function(oper)
                    	{	  
                   		   $("#newUser").html(oper);  
                   		   
                    	},

                    	error: function(error)
                    	{
                    	   alert(error);
                    	}

		            }); //end ajax
    		});	
     	});


	 </script>
</head>

<body>

	<div class="container">
		
		<!--Header/Menu-->
		<div class="row">

			<?php 
				include("../modules/sections/header_manager.php");
	 		?>
		</div> <!--Row-->

	</div>

	<!--Container Principal-->

	<div class="container">


		<div class="row">
				<div class="page-header"><br><br>
					<h4>Nuevo Usuario</h4>
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
										<br>
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
										<br>

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

										<br>

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
										<br>

								
												
	      				
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
		<br>


		<div id="newUser">	
		</div>

	</div> <!--container principal-->

	<div class="container container2">
	    <div class="row">
			<div class="page-header">
				<h4>Recomendaciones Registro de Usuario</h4>
			</div>

				<ol class = "text-legal">
					<li>Para poder registrarse, usted debe ser ciudadano cedulado. Debe suministrar además, su nombre y apellido e indicar el rol del usuario (Administrador, Empleado, Cliente).</li>
					<li>El nombre de usuario debe tener 5 caracteres como mínimo y contener los siguientes elementos: letras y números (no obligatorio estos últimos). </li>
					<li>No se permiten como nombre de usuario espacios en blanco ni carateres especiales por ejemplo: (@ _ - $ % ).</li>
					<li>La contraseña debe tener como mínimo 6 caracteres y máximo 20. (No se hace distinción entre mayúsculas y minúsculas).</li>
					<li>Todos los campos son requeridos <span style = "color: #7E3F9D; font-weight: bold;">*</span></li>
				</ol>

				<p class="page-text-small bottom">
					
					<br>Trabajamos para brindarles los mejores tratamientos a los mejores precios. 
					Gracias por preferirnos.
				</p>
		</div>
	</div>
	

	<!--Footer-->
	

				<?php 
					include("../modules/sections/footer.php");
				 ?>		
		
	
	
</body>
</html>
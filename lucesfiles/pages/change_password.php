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
			<div class="page-header">
				<h4 class="space-top4">Cambiar Clave</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
				   	<div class="panel-heading clearfix">
				       <h3 class="panel-title">Clave de Acceso</h3>
				    </div>
				    <div class="panel-body">
				        <form class="form-horizontal" action="" method="POST" role="form" id="form-password">
					        <div class="form-group">
					            <label class="control-label col-sm-2 col-sm-offset-2" for="labelPassword">Clave Actual</label>
					            <div class="col-sm-5">
					              	<input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su clave actual" required /> 	
					            </div>   
					        </div>
					        <div class="form-group">
					            <label class="control-label col-sm-2 col-sm-offset-2" for="labelNewPassword">Nueva Clave</label>
					            <div class="col-sm-5">
					            	<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Ingrese una nueva clave"  required/> 
					            </div>      
					        </div>
							<div class="form-group">
					            <label class="control-label col-sm-2 col-sm-offset-2" for="labelnew_password2"></label>
					            <div class="col-sm-5">
					            	<input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Repita la nueva clave" required/> 
					            </div> 	    
					        </div>
					        <div class="form-group">
					            <div class="col-sm-4 col-sm-offset-4" id="change-pass"></div>  
					        </div>
							<div class="form-group space-top4">
	 							<div class="col-sm-4 col-sm-offset-5">
					              	<button class="medium-btn-purple " type="submit">Cambiar Clave</button>
					            </div>
							</div>
			 		  	</form>
		        	</div>
		      	</div>
			</div>
		</div>
	</div>
	<div class="container butterfly5" id="result-change-password">
	</div>	
	<!--Observations and Suggestions-->
	<?php 
		include("../modules/views/observations_and_suggestions/change_password.html");
	?>	
	<!--Footer-->
	<?php 
		include("../modules/sections/footer.php");
	?>			
	<!--Scripts-->
	<script type="text/javascript" src="../js/change_password.js"></script>	
</body>
</html>
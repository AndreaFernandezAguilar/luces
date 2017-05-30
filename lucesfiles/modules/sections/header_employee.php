<!--Menu - Employee-->

<div class="container">

<nav class="navbar navbar-default">
	<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button> 
			<!--<a class="navbar-brand" href="#">Brand</a>-->
			<a class="navbar-brand" href="#"><img class="logo-menu" src="../img/logo luces reducido.png"/></a>
		</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li>
 				<a href="home_employee.php" id="logout" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-home"> </span> Inicio </a>
 			</li>
			<li id="my-dropdown" class="dropdown"  >
		    	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-calendar"></span> Citas <span class="caret"></span></a>
		    
		    	<ul id="my-dropdown-menu" class="dropdown-menu">
		      		<li><a href="#">Nueva Cita</a></li>
		      		<li><a href="#">Consultar Cita</a></li>
		      		<li><a href="#">Editar Cita</a></li>
		      		<li><a href="#">Eliminar Cita</a></li>
		    	</ul> <!-- dropdown-menu -->

	    	</li> <!-- dropdown -->
						
			<li id="my-dropdown" class="dropdown">
		    	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-folder-open"> </span>  Historias <span class="caret"></span> </a>
		    	
		    		<ul id="my-dropdown-menu" class="dropdown-menu">
		      			<li><a href="new_medical_history.php">Nueva Historia</a></li>
		      			<li><a href="view_medical_history.php">Consultar Historia</a></li>
		      			<li><a href="edit_medical_history.php">Editar Historia</a></li>
		      			<!--<li><a href="delete_medical_history.php">Eliminar Historia</a></li>-->
		    		</ul> <!-- dropdown-menu -->

	    	</li> <!-- dropdown -->

			

		<!--	<li id="my-dropdown"  class="dropdown">
	        	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-duplicate"></span> Reportes<span class="caret"></span></a>
	        
	        		<ul id="my-dropdown-menu" class="dropdown-menu">
	          			<li><a href="report_patients.php">Datos de Pacientes</a></li>
	          			
	        		</ul> ropdown-menu 
	    	</li>  -->

	    	

 			<li>
 				<a href="../modules/logout.php" id="logout" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-off"> </span> Salir del Sistema</a> 
 			</li>
 		</ul><!-- nav navbar-nav --> 	      
 	</div><!-- /.navbar-collapse -->

</nav>

</div>
      
       
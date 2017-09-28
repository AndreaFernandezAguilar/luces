<!--Menu - Manager -->
<div class="container-fluid">			
	<div class="row">
		<nav class="navbar navbar-default navbar-fixed-top">
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
		 				<a href="home_manager.php" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-home"> </span> Inicio </a>
		 			</li>
		 			<li id="my-dropdown" class="dropdown">
				    	<a id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-user"></span> Usuarios <span class="caret"></span></a>
				    
				    	<ul id="my-dropdown-menu" class="dropdown-menu">
				      		<li><a href="new_user.php">Crear Usuario</a></li>
				      		<!--<li><a href="edit_user.php">Editar Usuario</a></li>-->
				      		<li><a href="delete_user.php">Editar/Eliminar Usuario</a></li>
				    	</ul> <!-- dropdown-menu -->
			    	</li> <!-- dropdown -->
					<li id="my-dropdown" class="dropdown"  >
				    	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-calendar"></span> Citas <span class="caret"></span></a>
				    	<ul id="my-dropdown-menu" class="dropdown-menu">
				      		<li><a href="new_appointment.php">Nueva Cita</a></li>
				      		<li><a href="view_appointment.php">Consultar Cita(s)</a></li>
				      		<li><a href="edit_appointment.php">Editar Cita</a></li>
				      		<li><a href="delete_appointment.php">Eliminar Cita</a></li>
				    	</ul> <!-- dropdown-menu -->
			    	</li> <!-- dropdown -->		
					<li id="my-dropdown" class="dropdown">
				    	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-folder-open"> </span>  Historias <span class="caret"></span> </a>
				    		<ul id="my-dropdown-menu" class="dropdown-menu">
				      			<li><a href="new_medical_history.php">Nueva Historia</a></li>
				      			<li><a href="view_medical_history.php">Consultar Historia</a></li>
				      			<li><a href="edit_medical_history.php">Editar Historia</a></li>
				      			<li><a href="delete_medical_history.php">Eliminar Historia</a></li>
				    		</ul> <!-- dropdown-menu -->
			    	</li> <!-- dropdown -->
			    	<li id="my-dropdown" class="dropdown">
				    	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-usd"> </span> Ventas<span class="caret"></span> </a>
				    		<ul id="my-dropdown-menu" class="dropdown-menu">
				      			<li><a href="new_sale.php">Nueva Venta</a></li>
				      			<li><a href="list_sales.php">Consultar Ventas</a></li>
				      			<li><a href="view_sales.php">Eliminar</a></li>		
				    		</ul> <!-- dropdown-menu -->
			    	</li> <!-- dropdown -->
					<!--<li id="my-dropdown" class="dropdown">
				    	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-piggy-bank"> </span> Promociones<span class="caret"></span> </a>
			    		<ul id="my-dropdown-menu" class="dropdown-menu">
			      			<li><a href="new_discount.php">Nueva Promoción</a></li>
			      			<li><a href="edit_discount.php">Editar Promoción</a></li>
			      			<li><a href="delete_discount.php">Eliminar Promoción</a></li>
			      			<li><a href="view_discounts.php">Ver Promociones</a></li>	
			    		</ul>
		    		</li> -->
			    	<li id="my-dropdown"  class="dropdown">
			        	<a  id="my-dropdown-toggle" class="dropdown-toggle" data-toggle="dropdown-menu" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Mi Cuenta<span class="caret"></span></a>
			        		<ul id="my-dropdown-menu" class="dropdown-menu">
			          			<li><a href="change_password.php">Cambiar Clave</a></li>		
			        		</ul> <!-- dropdown-menu -->
			    	</li> <!-- dropdown -->
		 			<li>
		 				<a href="../modules/logout.php" id="logout" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-off"> </span> Salir</a> 
		 			</li>
		 		</ul><!-- nav navbar-nav --> 	      
		 	</div><!-- /.navbar-collapse -->

		</nav>
	</div>	      
</div>      
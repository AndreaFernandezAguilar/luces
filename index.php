<!DOCTYPE html>
<html>
<link rel="icon" type="image/png" href="http://www.sistemaluces.com/lucesfiles/img/favicon-32x32.png" sizes="32x32" /> 
<link rel="icon" type="image/png" href="http://www.sistemaluces.com/lucesfiles/img/favicon-16x16.png" sizes="16x16" /> 
<head>
<meta charset="ISO-8859-1">
<title>Luces Medical Spa - Luce como sue&ntilde;as...</title>
<link href="lucesfiles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="lucesfiles/css/custom.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,700italic,900,400italic,300italic,300,100italic,100,900italic' rel='stylesheet' type='text/css'>
</head>
<body class="login-body" style="background: url('lucesfiles/img/mariposa rosa.png') center center fixed; 
 -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;">
	<div class="container">
		<div class="jumbotron" id="login">
			<form action="lucesfiles/modules/validate_session.php" method="POST">
				<h2 class="form-signin-heading" style="text-align: center;">Bienvenida</h2>
	        	<label for="username" class="sr-only">Usuario</label>
			 	<input name="username" id="username" placeholder="Usuario" class="form-control" type="text"/><br>
			    <label for="password" class="sr-only">Contraseña</label>
			    <input name="password" id="password" placeholder="Contraseña" class="form-control" type="password"/>
				<div class="checkbox">
		        	<label>
		            	<input type="checkbox" value="remember-me"> No cerrar sesi&oacute;n
		        	</label>
		        </div>
			    
			    <button class="big-btn-purple" id="submit" type="submit">Entrar</button>
				
			</form>
			<div id="login-logo"><img class="logo" src="lucesfiles/img/logo luces.png"/></div>
		</div> <!-- jumbotron -->

		<div class="row">
			<div class="col-md-4 col-md-offset-4">
			  <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <h4 style="text-align: center;">ERROR DE AUTENTICACIÓN</h4>
                    </div>
          
              <?php endif ?>
            </div>
		</div>
  	</div> <!-- /container -->
</body>

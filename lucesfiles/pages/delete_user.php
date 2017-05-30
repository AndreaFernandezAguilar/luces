<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);
?>

<body>		
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
		require_once ('../modules/class/user.class.php');
		$users= new User();
		$br=$_SESSION["id_branch"];
		$list_users= $users->getUsersList($br);
	?>
	<!--Container Principal-->
	<div class="container">
		<div class="row">
			<div class="page-header"><br><br>
				<h4>Eliminar Usuario</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			   <table class="table table-bordered formulario table2" id="list-users-table" >
					<tr>
						<th>Nombre</th>
					    <th>Apellido</th>
					    <th>Cédula de Identidad</th>
					    <th>Usuario</th>
					    <th>Acción</th>
				  	</tr>
					<?php foreach ($list_users as $user):?>
					<form class="form-users table2" method="POST" action=""> 
						<tr id="tr_<?php echo $user['0'] ?>">	
							<td><?php echo $user['1'] ?></td>
							<td><?php echo $user['2'] ?></td>
							<td><?php echo $user['3'] ?></td>
							<td><?php echo $user['4'] ?></td>
							<td><button type="button" class="medium-btn-purple delete-user"  id="<?php echo $user['0'] ?>">Eliminar Usuario</button>
							</td>
						</tr>
						<input type="hidden" value="<?php echo $user['0'] ?>" id="id" name="id">
					</form>
 					<?php endforeach ?>
				</table>
			</div>
	
			<div id="delete-message">
			</div>
		</div>
	</div> <!--container principal-->

	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/delete_user.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/delete_user.js"></script>	
</body>
</html>
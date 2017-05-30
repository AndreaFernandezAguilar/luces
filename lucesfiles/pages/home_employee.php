<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session();
    $user=$_SESSION['name'];
?>

<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_employee.php");
	?>
	<!--Container Principal-->
	<div class="container">
		<div class="row butterfly2">
			<div class="page-header"><br><br>
				<h4>Bienvenida, <?php echo $user."."?></h4>
			</div>
		</div>
		<div class="row">
			<div class="cite col-md-8 col-md-offset-2">
			      <p class="text-cite">"La salud es belleza y la más perfecta salud es la más perfecta belleza."</p>
			      <p class="cite-small">William Shenstone</p> 
			</div>
		</div>
		<br>
	</div>
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/home_employee.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/home_employee.js"></script>	
</body>
</html>
<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session();
    $user=$_SESSION['name'];
?>
<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
		require_once ("../modules/class/appointment.class.php");
	?>

	<!--Container Principal-->
	<div class="container ">
		<div class="row ">
				<div class="page-header"><br><br>
					<h4>Bienvenida, <?php echo $user."."?></h4>
				</div>
		</div>
		<!--<div class="row">
			<div class="cite col-md-8 col-md-offset-2">
			      <p class="text-cite">"La salud es belleza y la más perfecta salud es la más perfecta belleza."</p>
			      <p class="cite-small">William Shenstone</p> 
			</div>
		</div>-->
		<div class="row vcenter">
			<div class="cite col-md-2 ">
			      <p class="text-cite">"La salud es belleza y la más perfecta salud es la más perfecta belleza."</p>
			      <p class="cite-small">William Shenstone</p> 
			</div>
			<div class="col-md-8 ">
				<div id="calendar" ></div>
			</div>
		</div>
		<br>
	</div> <!--container principal-->
	<?php 
		/*Modal*/
		include("../modules/views/modal.html");
		/*Observations and Suggestions-*/
		include("../modules/views/observations_and_suggestions/home_manager.html");
		/*Footer*/
		include("../modules/sections/footer.php");
	 ?>	
	<!--Scripts-->
	<script type="text/javascript" src="../js/home_manager.js"></script>		
</body>
</html>
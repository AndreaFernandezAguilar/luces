<head>
	<?php 
		require_once ('../modules/class/connection.class.php');
        $conect = new Connection();
            
        if (!isset($_SESSION['id_role']) || !isset($_SESSION['id_user']))
        {    
               header('Location: ../../index.php?error=true');
        }


         elseif ($_SESSION['id_role']!=1 && $_SESSION['id_role']!=2)  
        {        
           header('Location: ../../index.php?error=true');
        }

		
		else
		include("../modules/sections/head.php");
	 ?>
	<script src="../js/alerts.js"></script>
<script type="text/javascript">
	 $(document).ready(function()
     	{
     		$("#form-show-history").submit(function(e)
		  	{
				e.preventDefault();
				var identityCard = $("#identityCard").val();
				var oper="view";

				//AJAX
    			$.ajax(
    				{
    					url: "../modules/controllers/show_medical_history-controller.php",
    					type:"post",
    					data:
    					{	
    						
                            "identityCard":identityCard,
                            "oper":oper
    					},

                    	success: function(oper)
                    	{
                   		   $("#medicalHistory").html(oper);

                   		  /* $(".alert").addClass("in").fadeOut(4500);
								$('[data-toggle=collapse]').click(function(){
								  	// toggle icon
								  	$(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
								}); */
                   		  
                   		   $(':checkbox').click(function()
                   		   {
								return false;        
						   });

                   		  
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
	<!--Header/Menu-->
		<?php 
			if ($_SESSION['id_role']==1)
			include("../modules/sections/header_manager.php");
				
			elseif($_SESSION['id_role']==2)
			include("../modules/sections/header_employee.php");
		?>
	
	<div class="container">
		<div class="row">
				<div class="page-header"><br><br>
					<h4>Historia Médica</h4>
				</div>
		</div>

		<div class="row">
			<div class="col-md-12">

				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			          <h3 class="panel-title">Consultar Historia</h3>
			        </div>
	        
			        <div class="panel-body">
			          <form class="form-horizontal" action="../modules/controllers/show_medical_history-controller.php" method="POST" role="form" id="form-show-history">
			          	
				            <div class="form-group">
				              <label class="control-label col-sm-4" for="labelCedula">C.I del Paciente</label>
				              
				              <div class="col-sm-4">
				              	<input type="number" class="form-control" id="identityCard" name="identityCard" placeholder="Introduzca Cédula de Identidad" /> 
								
				              </div>

				              <div class="col-sm-4">
				              	<button class="medium-btn-purple " type="submit">Buscar Paciente</button></div>
				              
				             </div>

		 		  	  </form>
		 		  	 
		 		  	 
	        	</div><!--Panel,body-->
	      	</div><!--Panel,default-->

			</div><!--colmd8-->
		</div><!--row-->

	</div><!--Container-->	

	

	<div class="container butterfly2" id="medicalHistory">


	</div>	


		
	<div class="container container2">
		
	    <div class="row">
			<div class="page-header">
				<h5>Condiciones de los Tratamientos</h5>
			</div>

				<p class="page-text-small bottom">
					1. Todos nuestros tratamientos tienen una vigencia m&aacute;xima de 3 meses para la aplicaci&oacute;n del mismo, 
					contados a partir de la fecha de facturaci&oacute;n (los de mantenimiento inclusive). <b>SIN EXCEPCIONES</b>. 
					<br>2. Todos nuestros tratamientos son: <b>NO TRANSFERIBLES</b> y <b>NO REEMBOLSABLES</b>. <b>SIN EXCEPCIONES</b>. 
					<br>3. Si usted no confirma su cita antes de las 3 pm del d&iacute;a anterior a su tratamiento, autom&aacute;ticamente 
					perder&aacute; dicha cita. 
					<br>4. Si usted pierde 2 citas consecutivas daremos por realizadas las mismas. <b>SIN EXCEPCIONES</b>. 
					<br>5. Si usted llega retrasada a su cita, solo se le atender&aacute; si le resta suficiente tiempo para la 
					aplicaci&oacute;n completa del tratamiento. <b>SIN EXCEPCIONES</b>.
					
					<br>Trabajamos para brindarles los mejores tratamientos a los mejores precios, esa es la causa de nuestro gran n&uacute;mero de pacientes. 
					Gracias por preferirnos.
				</p>
		</div>
	
	</div> <!--container principal-->


	<!--Footer-->

				<?php 
					include("../modules/sections/footer.php");
				 ?>		
		
	
	
</body>
</html>
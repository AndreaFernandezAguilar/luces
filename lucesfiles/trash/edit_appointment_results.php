<body>

	<!--Header/Menu-->
		<?php 
			include("../modules/sections/header_manager.php");
	 	?>



	<!--Container Principal-->

	<div class="container" id="principal">

		<div class="row">
				<div class="page-header"><br><br>
					<h4>Editar Cita</h4>
				</div>
		</div>

		<div class="row" id="rowPanel">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
			        <div class="panel-heading clearfix">
			          <i class="icon-calendar"></i>
			          <h3 class="panel-title">Datos de la Cita</h3>
			        </div>
	        
			        <div class="panel-body">
			          	<form class="form-horizontal" action="" method="POST" role="form" id="form-edit-appointment">
			          		<br>
				            <div class="form-group">
				            	<label class="control-label col-sm-3 col-sm-offset-2">C.I del Paciente</label>
								<div class="col-sm-4">
									<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del paciente" type="number" maxlength="10" minlength="7"  style="" required>
										<div id="validate-identityCard"></div>  
				              	</div>
				            </div>
							<br>
							<div class="form-group">
								<label class="control-label col-sm-3 col-sm-offset-2">Sucursal</label>
									        <div class="col-sm-4 selectContainer" >
									            <select class="SlectBox" id="branch-select-box" name="branch" id="branch">
										            <option value="0" selected>Seleccione...</option>
										       	    <?php foreach ($branches as $branch): ?>
							                                    <option value="<?php echo $branch['0'] ?>"><?php echo $branch['1'] ?></option>
							                        <?php endforeach ?> 
									            </select>
									    	</div>
							</div>
							<br>	
							<div class="form-group">
				              	<label class="control-label col-sm-3 col-sm-offset-2" for="labelTreatment">Tratamiento</label>
				              	<div class="col-sm-4">
									    <select class="SlectBox" name="treatment-select-box" id="treatment-select-box">
											<option value="0" selected>Seleccione...</option>
												<?php foreach ($treatments as $treatment): ?>
									                <option value="<?php echo $treatment['0'] ?>"><?php echo $treatment['1'] ?></option>
									            <?php endforeach ?> 
									    </select>
								</div>        	    
				            </div>
				            <br>
				            <div class="form-group">
				            	<label class="control-label col-sm-3 col-sm-offset-2" for="labelAppointment">Fecha de la Cita</label>
				            	<div class="col-sm-4">
				            		<input type="" class="form-control datepicker" name="appoitment" id="appointment" required>
				            	</div>

				            </div>
				            <br>
				            <div class="form-group">
				              	<label class="control-label col-sm-3 col-sm-offset-2" for="labelTreatment">Acción a realizar</label>
				              	<div class="col-sm-4">
									    <select class="SlectBox" name="action-select-box" id="action-select-box">
											<option value="0" selected>Seleccione...</option>
											<option value="1">Modificar estatus: Confirmada</option>
											<option value="2">Modificar estatus: Atendida</option>
											<option value="3">Modificar fecha</option>
									    </select>
								</div>        	    
				            </div>
							<br>
							<br>

							<div class="form-group">
 								<div class="col-sm-4 col-sm-offset-5">
				              		<button class="medium-btn-purple " type="submit">Siguiente</button>
				              	</div>
							</div>
		 		  	  	</form>
		 		  	 
		 		  	 
	        	</div><!--Panel,body-->
	      	</div><!--Panel,default-->

			</div><!--colmd8-->
		</div><!--row-->
		
		<div class="row" id="results">		
		</div>

		<div class="row" style="margin-top:50px;">
			<div class="col-md-4 col-md-offset-4" id="saveChanges">
			</div>
		</div>
	</div> <!--container principal-->

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
	</div>
	

	<!--Footer-->
	

				<?php 
					include("../modules/sections/footer.php");
				 ?>		
		
	
	
</body>
</html>
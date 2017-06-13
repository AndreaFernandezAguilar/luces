<?php 
	require_once ('../modules/class/connection.class.php');
    $conect= new Connection();
    $conect->validate_session($role=1);
    require_once('../modules/class/user.class.php');
	require_once('../modules/class/treatment.class.php');
	require_once('../modules/class/sale.class.php');
	require_once('../modules/class/history.class.php');
	$user = new User();
	$branches = $user->getBranches();
	$roles=$user->getRoles();
	$treat= new Treatment();
	$treatments=$treat->getTreatmentsList();
	$sale=new Sale();
	$sale_details=$sale->getSale($_REQUEST['id_sale']);
	$paidTreatments=$sale->getPaidTreatments($_REQUEST['id_sale']);
	$patient= new History();
	$identityCard=$patient->getIdentityCard($sale_details[4]);
?>
<body>
	<!--Header/Menu-->
	<?php 
		include("../modules/sections/header_manager.php");
	?>
	<!--Main Container-->
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h4 class="space-top4">Editar Venta</h4>
			</div>
		</div>

		<form method="POST" class="form-horizontal" id="form-edit-sale">
		<div class="row">			
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="glyphicon glyphicon-edit pull-right"></i>
							<h4>Datos Generales de la Venta</h4>
						</div>
					</div>
					<div class="panel-body">	    
						<div class="row">
							<div class="col-md-11">
								<br>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">No. de Factura</label>
									<div class="col-sm-5">
										<input type="text" name="receiptNumber" id="receiptNumber" class="form-control" placeholder="Ingrese número de factura" value="<?php echo $sale_details[1]; ?>"readonly>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2">C.I del Cliente</label>
									<div class="col-sm-5">
										<input class="form-control" name="identityCard" id="identityCard" placeholder="Cédula del cliente" type="number" maxlength="10" minlength="7" value='<?php echo $identityCard; ?>' readonly>
										<div id="validate-identityCard"></div>  
									</div>
								</div>
								<br>
								<div class="form-group">
									<label class="control-label col-sm-3 col-sm-offset-2" >Sucursal</label>
									<div class="col-sm-5 selectContainer" >
										<select class="SlectBox" id="branch-select-box" name="branch" id="branch">
											<option value="0" selected>Seleccione...</option>
											<?php foreach ($branches as $branch): ?>
											<option value="<?php echo $branch['0'] ?>" <?php if($branch[0]==$sale_details[3]) echo "selected"; ?>><?php echo $branch['1'] ?></option>
											<?php endforeach ?> 
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>			    
		<div class="row space-top4">			
			<div class="col-md-12">
				<div class="panel panel-default" style="margin-bottom:70px;">
					<div class="panel-heading">
						<div class="panel-title">
							<i class="glyphicon glyphicon-edit pull-right"></i>
							<h4> Agregar Tratamiento</h4>
						</div>
					</div>

					<div class="panel-body">	    
						<div class="row">
							<div class="col-md-11">
								<br>			
								<div class="form-group">
									<label class="control-label col-md-2">Tratamiento</label>
									<div class="col-md-3 selectContainer" >
										<select class="SlectBox" name="treatment-select-box" id="treatment-select-box">
											<option value="" selected>Seleccione...</option>
											<?php foreach ($treatments as $treatment): ?>
											<option value="<?php echo $treatment['0'] ?>"><?php echo $treatment['1'] ?></option>
											<?php endforeach ?> 
										</select>
									</div>
						
									<label class="control-label col-md-1 ">Área</label>
									<div class="col-md-3 selectContainer" id="list_bodyareas">
										<select class="SlectBox" id="bodyarea-select-box" name="bodyarea-select-box">
											<option value="0" selected>Seleccione...</option>
										</select>
									</div>
							
									<label class="control-label col-md-1">Cantidad</label>
									<div class="col-md-1">
										<input type="number" name="numberOfTreatments" id="numberOfTreatments" class="form-control" min="1">
									</div>

									<div class="col-md-1">
										<a id="addField" class="btn btn-circle" href="#"><span class="glyphicon glyphicon-plus"></span></a>
									</div>	
								</div> 
								</div> <!-- col-panel-->
							</div> <!--row-panel-->		
						</div><!--panel-body-->
				</div><!--panel-default-->
			</div>
		</div>
		<div class="row">
			<div class="page-header"><br><br>
				<h4>Tratamientos Registrados</h4>
			</div>
		</div>
		<div class="row">
			<div class="text-center">
				<img src="../img/loading.gif" class="hidden" id="img-loading">
			</div>
			<div class="col-md-8 col-md-offset-2" id="treatments-registered">
			   <table class="table table-bordered formulario table2" id="treatmentsTable" name="treatmentsTable">
					<tr>
						<th class="col-md-3">Tratamiento</th>
						<th class="col-md-3">Área del Cuerpo</th>
						<th class="col-md-3">Cantidad</th>
						<th class="col-md-3">Eliminar</th>
					</tr>
					<?php foreach ($paidTreatments as $paidTreat):?>
					
					<tr id="tr_<?php echo $paidTreat[0] ?>">
						<td class="col-md-3">
							<?php 
								foreach ($treatments as $treatment) 
								{
									if ($treatment[0]==$paidTreat[2])
									echo $treatment['1'] ;
								}
							 ?>
							

						</td>
						<td class="col-md-3">
							<!--<select class="SlectBox" id="bodyarea-select-box" name="bodyarea-select-box">
								<?php $bodyareas= $treat->getTreatment_BodyArea($paidTreat[2]); ?>
								<option value="0">Seleccione...</option>
								<?php foreach ($bodyareas as $bodyarea): ?>
									<option value="<?php echo $bodyarea['0'] ?>" <?php if ($bodyarea[0]==$paidTreat[3]) echo 'selected'; ?>><?php echo $bodyarea['1'] ?></option>
								<?php endforeach ?>
							</select>-->


							<?php 
								 foreach($bodyareas as $bodyarea)
								{
									 if ($bodyarea[0]==$paidTreat[3])
									 	echo $bodyarea['1'] ;
								}
							 ?>

						</td>
						<td class="col-md-3">
							<div class="col-md-8 col-md-offset-2">
								<input  class="newQ form-control" id="newQ_<?php echo $paidTreat[0] ?>" name="newQ_<?php echo $paidTreat[0] ?>" type="number" value="<?php echo $paidTreat[1]; ?>" min="1">
							</div>
							<input id="idTB_<?php echo $paidTreat[0] ?>" name="idTB_<?php echo $paidTreat[0] ?>" type="hidden" readonly value="<?php echo $paidTreat[0]; ?>" class="idTB">
							<input id="currentQ_<?php echo $paidTreat[0] ?>" name="currentQ_<?php echo $paidTreat[0] ?>" type="hidden" readonly value="<?php echo $paidTreat[1]; ?>" class="currentQ">
							<input type="hidden" name="idSale" id="idSale" value="<?php echo $_REQUEST['id_sale']; ?>">
							<?php //echo $paidTreat[1]; ?>
						</td>
						<td class="col-md-1">
							<button class="btn btn-circle delete-treatment" type="button" id="dbutton_<?php echo $paidTreat[0] ?>"><span class="glyphicon glyphicon-remove"></span></button>
						</td>
					</tr>


					<?php endforeach ?>
				</table>
			</div>
		</div>	

		<div class="row" style="text-align:center;" id="buttonUpdateSale">		
			<button type="submit" class="medium-btn-purple">Actualizar</button>
		</div>

		</form>

		<div id="edit_sale_container">	
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
		include("../modules/views/modal.html");
		include("../modules/sections/footer.php");
	?>

	<script type="text/javascript" src="../js/add_treatmentToSale.js"></script>
	<script>
		$(document).ready(function()
		{   	
			$('.SlectBox').SumoSelect();

			$("#treatment-select-box").change(function(e)
     		{	
     			 var treatment= $("#treatment-select-box").val();
     				//var opc=1;
     			 
     			//AJAX - Treatment
    			$.ajax(
    			{
    				url: "../modules/controllers/treatment-controller.php",
    				type:"post",
    				data:
    				{	
                    	"treatment":treatment,
                        //"opc":opc
    				},

                    success: function(oper)
                    {
                   		$("#list_bodyareas").html(oper);
                   		 $('.SlectBox').SumoSelect();
                   		/*$('#bodyarea').SumoSelect(
                   		{
						  	placeholder: 'Seleccione...',
						    selectAll: true,
						    selectAlltext: 'Seleccionar Todas',
						    triggerChangeCombined: false,
						    captionFormat: '{0} Seleccionadas'
						});*/
                   	},

                  	error: function(error)
                    {
                    	alert(error);
                    	 setTimeout(function ()
						{
							swal({   title: "ERROR",   text: "Se ha producido un error:"+error,   type: "error", confirmButtonClass: "btn-default" });
						},100);	
                    }
		        }); //end AJAX Treatment	
     		});//end Treatment SelectBox  	



			$(document).on("click",".delete-treatment",function()	
			{
				var x=$(this).attr("id").split("_");
		  		var btba=x[1];
		  		var idSale=$("#idSale").val();

				$(".modal-title").html("Eliminar Tratamiento de la Venta");
				$(".modal-body").html("<h4 class='text-center'>¿Estás seguro(a) que desea eliminar el tratamiento?</h4>");
				$(".modal-button-confirm").attr("id",btba);
				$('#genericModal').modal();

 
 				
				$(".modal-button-confirm").click(function(e)
				{
				
					e.preventDefault;

					var tba=$(this).attr("id");
					$("#genericModal").modal("hide");

					//AJAX - Delete Treatment from Sale
					$.ajax(
	    			{	

	    				url: "../modules/controllers/delete_treatment_sale-controller.php",
	    				type:"post",
	    				data:
	    				{	
	    					"idSale":idSale,
	                    	"idTreatmentBodyArea":tba
	    				},

	                    success: function(data)
	                    {
	                    	
	                    	$("#edit_sale_container").html(data);

	                    	var r=parseInt(data);

	                    	if(r==0)
	                    	{
	                    		$("#tr_"+tba).remove();

	                    	}


	                    	if(r==1)
	                    	{
	                    		
	                    		$("#tr_"+tba).remove();

	                    		
	                    		 setTimeout(function ()
								{
									swal({   title: "Registro Eliminado",   text: "El tratamiento ha sido eliminado de la venta",   type: "success", confirmButtonClass: "btn-default" });
								},100);

	                    	}
	                    	

						},

						error: function(error)
	                    {
	                    	alert(error);
	                    	 setTimeout(function ()
							{
								swal({   title: "ERROR",   text: "Se ha producido un error:"+error,   type: "error", confirmButtonClass: "btn-default" });
							},100);	
	                    }
		       		 }); //end AJAX Delete Treatment from Sale	


					//$("#img-loading").removeClass("hidden");
					//$('#treatments-registered').load(document.URL +  ' #treatments-registered');
				});
			});

     		$("#form-edit-sale").submit(function(e)
		  	{
		  		e.preventDefault();
		  		var toInsert=[];
		  		var toDelete=[];
		  		var idSale=$("#idSale").val();

		  		$(".newQ").each(function()
		  		{
		  			console.log($(this).attr("id"));
		  			var x=$(this).attr("id").split("_");
		  			var c=x[1];
		  			var idTBA=parseInt($("#idTB_"+c).val());
		  			var nQ=parseInt($(this).val());

		  			if(nQ== $("#currentQ_"+c).val())
		  			{
		  				console.log("Keep:"+c);
		  				console.log("nuevo valor:"+nQ);
		  				//console.log("valor actual:"+$("#currentQ_"+c).val());
		  			}

		  			else if(nQ>$("#currentQ_"+c).val())
		  			{	
		  				console.log("Insert new:"+c);
		  				var qToInsert=nQ - $("#currentQ_"+c).val();
		  				
		  				//console.log("ID TBA: "+idTBA);
		  				console.log("Registros a agregar:"+qToInsert);
		  				toInsert.push({"idTreatmentBodyArea":idTBA,"quantity":qToInsert});
		  				//console.log({"idTreatmentBodyArea":idTBA,"quantity":qToInsert});
		  				//toInsert.each()
		  			}

		  			else if(nQ<$("#currentQ_"+c).val())
		  			{
		  				console.log("Delete:"+c);
		  				var qToDelete=$("#currentQ_"+c).val()- nQ ;
		  				console.log("Registros a borrar:"+qToDelete);
		  				toDelete.push({"idTreatmentBodyArea":idTBA,"quantity":qToDelete})


		  			}

		  		});

		  		console.log("Registros a agregar:");
		  		$.each(toInsert, function( key, value ) {
						  console.log( "ID TBA: "+value.idTreatmentBodyArea );
						  console.log( "quantity: "+value.quantity );
						});

		  		console.log("Registros a eliminar:");
		  		$.each(toDelete, function( key, value ) {
						  console.log( "ID TBA: "+value.idTreatmentBodyArea );
						  console.log( "quantity: "+value.quantity );
						}

						);




		  		//AJAX - Update Sale
    			$.ajax(
    			{
    				url: "../modules/controllers/edit_sale-controller.php",
    				type:"post",
    				data:
    				{	
                    	"toInsert":toInsert,
                    	"toDelete":toDelete,
                    	"idSale":idSale
    				},

                    success: function(oper)
                    {
                   		$("#edit_sale_container").html(oper);

                   		setTimeout(function ()
						{
							swal({ title: "Actualización exitosa",   text: "La venta se ha actualizado correctamente.",   type: "success", confirmButtonClass: "btn-default" });
						},100);	

						/*setTimeout(function ()
						{
							window.location.reload();
						},5000);*/
                   	
                   	},

                  	error: function(error)
                    {
                    	alert(error);
                    	 setTimeout(function ()
						{
							swal({   title: "ERROR",   text: "Se ha producido un error:"+error,   type: "error", confirmButtonClass: "btn-default" });
						},100);	
                    }
		        }); //end AJAX Update Sale	
     			

		  	});

		});

	</script>
</body>
</html>
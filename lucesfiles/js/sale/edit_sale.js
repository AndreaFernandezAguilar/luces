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


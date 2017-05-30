  var AddButton = $("#addField"); //ID del Botón Agregar
		    var count=1;

		    $(AddButton).click(function (e) 
		    {
		        var treatmentSelected=$('#treatment-select-box').val();
		        var bodyAreaSelected=$('#bodyarea').val();
		        var numberOfTreatments=$("#numberOfTreatments").val();

				if ($('#treatment-select-box').val()==0) 
				{
					alert ("Seleccione el Tratamiento");
					return false;
				};


				if ($('#bodyarea').val()==0) 
				{
					alert ("Seleccione el área a realizar el tratamiento");
					return false;
				};


				if ($('#numberOfTreatments').val()=='') 
				{
					alert ("Ingrese la cantidad del tratamiento");
					return false;
				};

    
				//var idTBA=parseInt($("#idTB_"+c).val());
					
		        //AJAX


		      var idSale=$("#idSale").val();

    			$.ajax(
    				{

    					url: "../modules/controllers/treatment_bodyarea-controller.php",
    					type:"post",
    					data:
    					{	
    						
                            "treatmentSelected":treatmentSelected,
                            "bodyAreaSelected":bodyAreaSelected,
                            "numberOfTreatments":numberOfTreatments,
                            "count":count,
                           	"idSale":idSale
    					},

                    	success: function(data)
                    	{
                   		   //$("#list_bodyareas").html(data);
                   		   //$('.SlectBox').SumoSelect();

                   		   var res= parseInt(data);
                   		   if(isNaN(res))
                   		   {

                   		   		$(treatmentsTable).append(data);
                   		   		count=count+1;
                   		  		$('#buttonNewSale').html('<div class="col-md-4 col-md-offset-4"><button  class="big-btn-purple" type="submit" style="margin-top: 40px; margin-bottom: 50px;">Registrar Venta</button></div>');
                   		  	}


                   		  	else
                   		  	{	

                   		  		$("#newQ_"+res).val(parseInt($("#newQ_"+res).val())+parseInt(numberOfTreatments));

                   		  		
                   		  	}
                   		  
                   		   

                   		   /*  var obj = [];
						    $('option:selected').each(function () {
						        obj.push($(this).index());
						        //$('#bodyarea')[0].sumo.unSelectItem($(this).index());
						    });

						    for (var i = 0; i <obj.length; i++)
						    {
						        $('#bodyarea')[0].sumo.unSelectItem(obj[i]);
						        $('#treatment-select-box')[0].sumo.unSelectItem(obj[i]);
						    }*/

						  	// Reset Fields
						  	$('#treatment-select-box')[0].sumo.selectItem(0);
						  	//$('#bodyarea')[0].sumo.selectItem(0);
						  	$('#list_bodyareas').html('<select class="SlectBox" id="bodyarea-select-box" name="bodyarea-select-box"><option value="0" selected>Seleccione...</option></select>');
						  	$('.SlectBox').SumoSelect();
						    $('#numberOfTreatments').val("");

                    	},

                    	error: function(error)
                    	{
                    	   alert(error);
                    	}

		            }); //end ajax
		           // $(treatmentsTable).append('<tr><td>'+treatmentSelected+'</td></tr>');

		            return false;
		        });
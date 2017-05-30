$(document).ready(function()
{
    var AddButton= $("#addField"); //ID del Botón Agregar
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

        //AJAX
		$.ajax(
		{
			url: "../modules/controllers/treatment_bodyarea-controller.php",
			type:"post",
			data:
			{				
                "treatmentSelected":treatmentSelected,
                "bodyAreaSelected":bodyAreaSelected,
                "numberOfTreatments":numberOfTreatments,
                "count":count
			},

        	success: function(data)
        	{
       		   $(treatmentsTable).append(data);
               count=count+1;
       		   $('#buttonNewSale').html('<div class="col-md-4 col-md-offset-4"><button  class="big-btn-purple" type="submit" style="margin-top: 40px; margin-bottom: 50px;">Registrar Venta</button></div>');
                // Reset Fields
			  	$('#treatment-select-box')[0].sumo.selectItem(0);
			  	$('#list_bodyareas').html('<select class="SlectBox" id="bodyarea-select-box" name="bodyarea-select-box"><option value="0" selected>Seleccione...</option></select>');
			  	$('.SlectBox').SumoSelect();
			    $('#numberOfTreatments').val("");
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}

        }); //end ajax
        return false;
    });
	
	$("#treatment-select-box").change(function(e)
	{	
		var treatment= $("#treatment-select-box").val();
		//AJAX
		$.ajax(
		{
			url: "../modules/controllers/treatment-controller.php",
			type:"post",
			data:
			{	
                "treatment":treatment
			},

        	success: function(data)
        	{
       		   $("#list_bodyareas").html(data);
       		   $('.SlectBox').SumoSelect();
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}
        }); //end ajax
	});

    $("#form-new-sale").submit(function(e)
	{
  		e.preventDefault();
  		if ($('select[name=branch]').val() ==='0')
		{
			alert('Seleccione la Sucursal');
			return false;
		}

		var receiptNumber=$("#receiptNumber").val();
  		var identityCard = $("#identityCard").val();	
		var branch=$("#branch-select-box").val();
		var treatments_s = [];
		var bodyareas_s=[];
		var numberOfTreatments_s=[];

		 $.each($('.treat_class'), function()
        {
        	treatments_s.push($(this).val());
        });


		  $.each($('.b_area_class'), function()
        {
           bodyareas_s.push($(this).val());
        });


		   $.each($('.n_treat_class'), function()
        {
           numberOfTreatments_s.push($(this).val());
        });

		//AJAX
		$.ajax(
		{
			url: "../modules/controllers/new_sale-controller.php",
			type:"post",
			data:
			{	
				"receiptNumber":receiptNumber,
                "identityCard":identityCard,
					"branch":branch,
				"treatments_s":treatments_s,
				"bodyareas_s":bodyareas_s,
				"numberOfTreatments_s":numberOfTreatments_s
			},

        	success: function(data)
        	{	  
       		   $("#newSale").html(data); 
       		   //$("#form-new-sale").reset();
       		   //$("#treatmentsTable").empty();

       		   //alert ("SUCESS");
       		   
        	},

        	error: function(error)
        	{
        	   alert(error);
        	}
        }); //end ajax
    });	
});

$(document).ready(function()
{
    $('.SlectBox').SumoSelect();
    $('#form-sales-list').submit(function(e)
    {
     	e.preventDefault();
     	var identityCard=$("#identityCard").val();
     	var dateTimeCreation=$("#dateTimeCreation").val();
     	var idBranch=$("#branch").val(); 

     	if(identityCard=='' && dateTimeCreation=='' && idBranch==0)
     	{
     		alert('Debes seleccionar al menos un campo');
     		setTimeout(function ()
			{
				swal({   title: "Datos Incompletos",   text: "Seleccione la Sucursal",   type: "warning", confirmButtonClass: "btn-default" });
			},100);	
			return false;
		}
     	
     	else
     	{
	     	$.ajax(
			{
				url:"../modules/controllers/list_sales-controller.php",
				type:"post",
				data:
				{
				    "identityCard":identityCard,
				    "idBranch":idBranch,
				    "dateTimeCreation":dateTimeCreation
				},

				success: function(oper)
				{	
				    $("#sales_list").html(oper);			
				},

				error: function (error)
				{
				    alert(error);
				}
			});//End AJAX Validate IdentityCard
	    }
    });//End submit form 
});

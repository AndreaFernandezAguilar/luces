$(document).ready(function()
{ 	
	var flagId=0;
	$(document).on('blur','input[name=identityCard]', function () 
	{
		if ($("#identityCard").val()!='')
		{	
		 	var identityCard=$("#identityCard").val();		
		 	//AJAX - Validate IdentityCard
		 	$.ajax(
		 	{
		 		url:"../modules/controllers/validate_identityCard-controller.php",
		 		type:"post",
		 		data:
		 		{
		 			"identityCard":identityCard
		 		},

		 		success: function(oper)
		 		{
		 			$("#validate-identityCard").html(oper);
		 				
		 		},

		 		error: function (error)
		 		{
		     		setTimeout(function ()
					{
						swal({   title: "ERROR",   text: "Ha ocurrido un error",   type: "error", confirmButtonClass: "btn-default" });
					},100);	
		 		}
		 	}); //End AJAX Validate IdentityCard
		}		    
	});
     
	$("#type-select-box").change(function(e)
    {  
     	var type=$("#type-select-box").val();
     	if (type==0) 
     	{	
     		$("#form_id").hide();
     		$("#form_branch").hide();
     		$("#form_treatment").hide();
     		$("#form_button").hide();
     	};
     		
 		if (type==1) 
 		{
 			$("#form_id").load("../modules/views/view_appointment_type-view.php");
 			$("#form_id").show();
 			$("#form_branch").show();
 			$("#form_treatment").show();
 			$("#form_button").show();
 		}

 		if (type==2) 
 		{
 		    $("#form_id").hide();
 			$("#form_branch").show();
 			$("#form_treatment").show();
 			$("#form_button").show();
 		};

 		$("#rowCalendar").empty();
 		$("#rowCalendar").html("<div id='calendar'></div>");
    });

     	$("#form-view-appointment").submit(function(e)
		{
		  	e.preventDefault();
		  	var type=$("#type-select-box").val();
		  	if(type==1)
		  	{
			  	if ($("#okId").length==0)
	     		{
	  				//alert ('Debes ingresar una cedula de identidad válida');
	  				setTimeout(function ()
					{
						swal({   title: "Error",   text: "Debes ingresar una cédula de identidad válida",   type: "error", confirmButtonClass: "btn-default" });
					},100);
	     			return ;
				}
			}

		  	if ($('select[name=treatment-select-box]').val() ==='0')
			{		
				setTimeout(function ()
				{
					swal({   title: "Datos Incompletos",   text: "Seleccione el Tratamiento",   type: "warning", confirmButtonClass: "btn-default" });
				},100);
					
				return false;
			}


		  	if ($('select[name=branch]').val() ==='0')
			{
				setTimeout(function ()
				{
					swal({   title: "Datos Incompletos",   text: "Seleccione la Sucursal",   type: "warning", confirmButtonClass: "btn-default" });
				},100);
					
				return false;
			}

			var identityCard = $("#identityCard").val();	
			var branch=$("#branch-select-box").val();
     		var treatment= $("#treatment-select-box").val();
			
			$('#calendar').fullCalendar('destroy')
			$('#calendar').fullCalendar(
			{				
				header: 
				{
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay',
				},

				views:
				{
					month: 
					{  
						//eventStartEditable: false,
						//editable:false,
						//droppable: false           
					},

					agendaDay:
					{
						//selectable:true
					}
				},

				eventConstraint:
				{
		            start: moment().format('YYYY-MM-DD'),
		            end: '2100-01-01' // hard coded goodness unfortunately
   				},

				
				events: [
				{
				    title:"Almuerzo",
				    start: '12:00', 
				    end: '13:00',
				    dow: [ 1,2,3,4,5,6 ], // Repeat 
				    editable:false,
				    rendering: 'background',
				    color:'#CCCCCC'
				}],


				dayClick: function(date, allDay, jsEvent, view) 
				{
            		$('#calendar').fullCalendar('gotoDate', date);
            		$('#calendar').fullCalendar('changeView', 'agendaDay');
        		},

      
		        eventSources: [  
				{   
					color:'#7E3F96',
				    editable:false,
				 	type: 'POST',
				    url: '../modules/controllers/view_appointment-controller.php', // use the `url` property
				          
					data:
    				{	
                        "identityCard":identityCard,
         				"branch":branch,
         				"treatment":treatment,
         				"type":type			
    				}

    			}],

    			eventDrop: function(event, delta) 
				{	
					start=event.start.format();
					end=event.end.format();
					flag=1;
				},

				eventOverlap: false,
				hiddenDays: [ 0 ],
				slotLabelFormat:'hh:mm a',
				allDaySlot:false,
				allDay:false,
				minTime:'08:00:00',
				maxTime:'19:00:00',
				slotDuration:'00:05:00',
				timeFormat: 'hh:mm a',
				editable: true,
				eventLimit: true, // allow "more" link when too many events

				eventAfterRender: function (event, element) 
				{
					var idAppointment=event.id;
					$.ajax(
					{
						url: "../modules/controllers/view_appointment-details-controller.php",
						type:"post",
						data:
						{	
							"idAppointment":idAppointment
						
						},

						success: function(oper)
						{	
							$("#testing").html(oper); 
							$(element).tooltip({title:oper,container: "body"}); 
						},

						error: function() 
						{
						    //alert('Ha ocurrido un error mientras se realizaban los cambios');
						    setTimeout(function ()
							{
								swal({   title: "ERROR",   text: "Ha ocurrido un error mientras se verificaba el calendario de citas",   type: "error", confirmButtonClass: "btn-default" });
							},100);
						}		
					});
				}
			});//end fullcalendar */s
		});//End Form
});//End Document
 
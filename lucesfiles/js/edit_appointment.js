$(document).ready(function()
{ 
	$("#form-edit-appointment").submit(function(e)
	{
		e.preventDefault();
		if ($("#okId").length==0 )
     	{
  			setTimeout(function ()
			{
				swal({   title: "Error",   text: "Debes ingresar una cédula de identidad válida",   type: "error", confirmButtonClass: "btn-default" });
			},100);

			$("#identityCard").focus();
     			return ;
			}


		  	if ($('select[name=branch]').val() ==='0')
			{
				setTimeout(function ()
				{
					swal({   title: "Datos Incompletos",   text: "Seleccione la Sucursal",   type: "warning", confirmButtonClass: "btn-default" });
				},100);
					
				return false;
			}

		  	if ($('select[name=treatment-select-box]').val() ==='0')
			{
				setTimeout(function ()
				{
					swal({   title: "Datos Incompletos",   text: "Seleccione el Tratamiento",   type: "warning", confirmButtonClass: "btn-default" });
				},100);
					
				return false;
			}


			if ($('select[name=action-select-box]').val() ==='0')
			{
				setTimeout(function ()
				{
					swal({   title: "Datos Incompletos",   text: "Seleccione la acción a realizar",   type: "warning", confirmButtonClass: "btn-default" });
				},100);
				return false;
			}


		  	var identityCard = $("#identityCard").val();	
			var branch=$("#branch-select-box").val();
     		var treatment= $("#treatment-select-box").val();
     		var appointment=$("#appointment").val();
     		var action= $("#action-select-box").val();

     		//AJAX confirm action
			$.ajax(
			{
				url: "../modules/controllers/edit_appointment-actions-controller.php",
				type:"post",
				data:
				{	
					"identityCard":identityCard,
					"branch":branch,
					"treatment":treatment,
					"appointment":appointment,
					"action":action
				},

				success: function(oper)
				{	  
					var htmlContent2= document.getElementById("rowPanel").innerHTML;
					$("#results").html(oper);

					var idAppointment=$("#idAppointment").val();
					var start,end,flag=0;
					//alert ("El id de la cita es:"+idAppointment);
					      
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
							},

							agendaDay:
							{
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
							url: '../modules/controllers/edit_appointment-events-controller.php',
							          
							data:
			    			{	
			                    "identityCard":identityCard,
			         			"branch":branch,
			         			"treatment":treatment,
			         			"idAppointment":idAppointment		
			    			}
			    		},

			    		// Appointment to edit
			    		{   
							color:'#F483CA',
							editable:true,
							durationEditable:false,
							type: 'POST',
							url: '../modules/controllers/edit_appointment-appointment-controller.php',          
							data:
			    			{	
			         			"idAppointment":idAppointment		
			    			},
			    		}],

			    		eventDrop: function(event, delta) 
						{	
							start=event.start.format();
							end=event.end.format();
							flag=1;
							//alert("la fecha de inicio es:"+start);
							//alert("la fecha final es:"+end);
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
						droppable: true, // this allows things to be dropped onto the calendar

					});//end fullcalendar

					if(action==3)
						$("#saveChanges").html('<form type="POST" id="formSaveChanges"><button type="submit" class="big-btn-purple">Guardar cambios</button></form>');

					$("#formSaveChanges").submit(function(e)
					{
						e.preventDefault();
						if(flag==1)
						{
							//AJAX save changes 
							$.ajax(
					    	{
					    		url: "../modules/controllers/edit_appointment-save_changes-controller.php",
					    		type:"post",
					    		data:
					    		{	
					                "idAppointment":idAppointment,
					         		"start":start,
					         		"end":end,			
					    		},

					    		success: function(oper)
					           {	  
					                $("#results").html(oper);
					                $("#saveChanges").empty();
					           },

					            error: function() 
				    			{
				               		//alert('Ha ocurrido un error mientras se guardaban los cambios');
				               		setTimeout(function ()
									{
										swal({   title: "ERROR",   text: "Ha ocurrido un error mientras se guardaban los cambios",   type: "error", confirmButtonClass: "btn-default" });
									},100);
				           		}
				           	}); //end AJAX save changes
						}

						else
						{
							setTimeout(function ()
							{
								swal({   title: "Aviso",   text: "No has realizado ningún cambio en la cita",   type: "warning", confirmButtonClass: "btn-default" });
							},100);
						}
					});
				},//end success


				error: function() 
				{         
				    setTimeout(function ()
					{
						swal({   title: "ERROR",   text: "Ha ocurrido un error mientras se guardaban los cambios",   type: "error", confirmButtonClass: "btn-default" });
					},100);
				}
			}); //End AJAX confirm action
     	});
	});

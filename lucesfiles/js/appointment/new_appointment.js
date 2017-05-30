
     	$(document).ready(function()
     	{
     	    //Global variables
		    var totalSeconds;
		    var appointmentTime;
		    var calendarStatus=0;
     		$('.SlectBox').SumoSelect();


	     	$('#incrementTime').click(function(e)
			{
				e.preventDefault();
				alert("Has aumentado el tiempo");
			});
    
		    $('#identityCard').blur(function(e)
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
		     				//alert(error);
		     				setTimeout(function ()
							{
								swal({   title: "ERROR",   text: "Ha ocurrido un error mientras se verificaba la cédula de identidad",   type: "error", confirmButtonClass: "btn-default" });
							},100);	
		     			}

		     		}); //End AJAX Validate IdentityCard
		     	}
		    });
  
	 		$("#aType-select-box").change(function(e)
     		{
     			if ($('select[name=branch]').val() ==='0')
				{
					//alert('Seleccione la Sucursal');
					setTimeout(function ()
					{
						swal({   title: "Datos Incompletos",   text: "Debes seleccionar la sucursal",   type: "warning", confirmButtonClass: "btn-default" });
					},100);
					return false;
				}



				else
				{
					var identityCard=$('#identityCard').val();
					var branch=$('#branch-select-box').val();
					var aType=$("#aType-select-box").val();
					var opc=0;

					     		

					
					//if($("#aType-select-box").val()==1)
     			 	//opc=2;

     				//else if($("#aType-select-box").val()==2)
     			 	//opc=1;

					//AJAX - to generate Treatments
	    			$.ajax(
	    			{
	    				url: "../modules/controllers/treatment-prepaid-controller.php",
    					type:"post",
    					data:
    					{	
                    		"identityCard":identityCard,
                        	"branch":branch,
                        	"aType":aType
    					},

    					success: function(oper)
    					{
    						$("#prepaid_treatments").html(oper);
    						$('.SlectBox').SumoSelect();
    					},

    					error:function()
    					{
    						alert(error);
							setTimeout(function ()
							{
								swal({   title: "ERROR",   text: "Se ha producido un error:"+error,   type: "error", confirmButtonClass: "btn-default" });
							},100);	
    					}

					}); //end AJAX to generate Treate
				}

				$(document).on("change","#treatment-select-box",function(e)
     		{	
     			var opc=0;
     			 var treatment= $("#treatment-select-box").val();
     			 //alert("cambio de trat");
     			 //Warning add if... opc depens on prepaid or nor
     			 
     			 if($("#aType-select-box").val()==1)
     			 {
     			 	opc=2;
     			 	 //alert("PRE elegido");

     			 }
     			 	
     			 else if($("#aType-select-box").val()==2)
     				{
     					opc=1;
     					//alert("Postpago elegido");
     				}



     			//AJAX - Treatment
    			$.ajax(
    			{
    				url: "../modules/controllers/treatment-controller.php",
    				type:"post",
    				data:
    				{	
                    	"treatment":treatment,
                        "opc":opc
    				},

                    success: function(oper)
                    {
                   		$("#list_bodyareas").html(oper);
                   		$('#bodyarea').SumoSelect(
                   		{
						  	placeholder: 'Seleccione...',
						    selectAll: true,
						    selectAlltext: 'Seleccionar Todas',
						    triggerChangeCombined: false,
						    captionFormat: '{0} Seleccionadas'
						});

						$(".SumoSelect li").bind('click.check', function(event) 
						{
	    					if ($('#bodyarea').val()) 
	    				 	var bodyareas =$("#bodyarea").val();
							
							else
							var bodyareas=0;
     								
     						var treatment= $("#treatment-select-box").val();
     			    				 
				     		//AJAX - Suggested Time
				    		$.ajax(
				    		{
				    			url: "../modules/controllers/suggested-time-controller.php",
				    			type:"post",
				    			data:
				    			{		
				                    "treatment":treatment,
				                    "bodyareas":bodyareas
				    			},

				                success: function(oper)
				                { 
				    				$("#testTime").val(oper);
				    				$("#suggestedTimePanel").html('<label class="control-label col-sm-5">Min.</label> <span class="badge" style=""><p id="totalMin">'+oper+'</p></span> <a id="incrementTime" class="btn btn-circle" style=""><span class="glyphicon glyphicon-plus"></span></a>');	                    						                    			
				                   	$("#calendarPanelBody").html('<button style="margin-left:70px;" type="submit" class="medium-btn-purple">Calendario</button></form>');
				    				var date = new Date(null);
				                   	totalSeconds=parseInt($('#totalMin').html())*60;
									date.setSeconds(totalSeconds);
									appointmentTime=date.toISOString().substr(11, 8);

									$('#calendar').fullCalendar(
									{
									    defaultTimedEventDuration: appointmentTime
	        						});	
        							
        							$('#incrementTime').click(function(e)
									{
										e.preventDefault();						
										if(calendarStatus==0)
										{
											var totalMin=parseInt($('#totalMin').html())+5;
											var date = new Date(null);
											
											$('#totalMin').html(totalMin);
											totalSeconds=parseInt($('#totalMin').html())*60;
									        date.setSeconds(totalSeconds);
									       	appointmentTime=date.toISOString().substr(11, 8);

									        $('#calendar').fullCalendar(
									        {
									        	defaultTimedEventDuration: appointmentTime
	        								});	
										}	

										else
										{
											setTimeout(function ()
											{
												swal({   title: "Importante",   text: "No puedes incrementar el tiempo de la cita una vez generado el calendario",   type: "warning", confirmButtonClass: "btn-default" });
											},100);	
										}										
									});					
				                },

				                error: function(error)
				                {
				                    //alert(error);
				                    setTimeout(function ()
									{
										swal({   title: "ERROR",   text: "Se ha producido un error:"+error,   type: "error", confirmButtonClass: "btn-default" });
									},100);	
				                }

						   	}); //end AJAX suggested time
				    	}); //end SumoSelect

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

     		});

			
  

			// FORM to generate the calendar 
     		$("#form-new-appointment").submit(function(e)
		  	{
		  		e.preventDefault();
		  		var identityCard = $("#identityCard").val();	
				var branch=$("#branch-select-box").val();
     			var treatment= $("#treatment-select-box").val();
     			var start,end,flag=0;

     			if ($("#okId").length==0 )
     			{
  					//alert ('Debes ingresar una cedula de identidad válida');
  					setTimeout(function ()
					{
						swal({   title: "Error",   text: "Debes ingresar una cédula de identidad válida",   type: "error", confirmButtonClass: "btn-default" });
					},100);

					$("#identityCard").focus();
     				return false;
				}

    		  	if ($('select[name=branch]').val() ==='0')
				{
					//alert('Seleccione la Sucursal');
					setTimeout(function ()
					{
						swal({   title: "Datos Incompletos",   text: "Seleccione la sucursal",   type: "warning", confirmButtonClass: "btn-default" });
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

				if ($('#bodyarea').val()) 
	    		var bodyareas =$("#bodyarea").val();
							
				else
				{
				    //alert('Seleccione al menos un area del cuerpo');
					    setTimeout(function ()
					{
						swal({   title: "Datos Incompletos",   text: "Seleccione al menos un área del cuerpo",   type: "warning", confirmButtonClass: "btn-default" });
					},100);
				    return false;
				}
     							
    			var tip='Arrastra el elemento "Nueva Cita" hasta el calendario';
				
				//Show Calendar and Events
                $("#rowCalendar").html("<br><br><br><div id='calendar'></div>");
                $("#external-events").html('<br><br><br><br><br><div class="panel panel-default" id="external-events"><div class="panel-heading"><h3 class="panel-title">Asignación de Cita</h3></div><div class="panel-body" ><span class="glyphicon glyphicon-info-sign col-md-offset-11" id="spanInfo"></span><div class="fc-event col-sm-10 col-md-offset-1" id="eventD" style="text-align:center; margin-bottom:22px;"">Nueva Cita</div></div></div>');
              	$("#spanInfo").tooltip({title:tip,container: "body"}); 
           
                //Disable select-box and button incrementTime
                $('#treatment-select-box').prop('disabled', 'disabled');
                $('#bodyarea').prop('disabled', 'disabled');
                calendarStatus=1;
                   		   

				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();

				//Define and Custom the calendar
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
							eventStartEditable: false,
							editable:false,
							droppable: false           
						},
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
					eventOverlap: false,
					hiddenDays: [ 0 ],
					slotLabelFormat:'hh:mm a',
					allDaySlot:false,
					allDay:false,
					minTime:'08:00:00',
					maxTime:'19:00:00',
					slotDuration:'00:05:00',
					timeFormat: 'hh:mm a',
					defaultTimedEventDuration: appointmentTime,
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					droppable: true, // this allows things to be dropped onto the calendar
					defaultView:'agendaWeek',

					drop: function(date) 
					{
						$(this).remove();
						$('#external-events').empty();
						start=date.format();
						var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration'));
						end = date.clone().add(defaultDuration); // on drop we only have date given to us
						end2=end.format(); 
					
					},

					eventDrop: function(event, delta) 
					{	
            			var d = new Date();
						if(event.start<d.getTime())
						{
							//alert ("¡La fecha no puede ser menor a la actual!");
							setTimeout(function ()
							{
								swal({   title: "Importante",   text: "¡La fecha no puede ser menor a la actual!",   type: "warning", confirmButtonClass: "btn-default" });
							},100);
						}

						else
						{
							start=event.start.format();
							end=event.end.format();
							flag=1;		
						}
					},
								
					 eventSources: [  
					 /*All appointments by patient*/
					 {
					 	type: 'POST',
					    url: '../modules/controllers/events_by_patient_appointments-controller.php', // use the `url` property
					          
						data:
	    				{	
	                        "identityCard":identityCard,
	         				"branch":branch,
	         				"treatment":treatment,
	         				"bodyareas":bodyareas		
	    				},

	    				success: function(oper)
                    	{	

                    	},

	    				error: function() 
	    				{
	               			//alert('Ha ocurrido un error mientras se cargaba el calendario de citas');
	               			setTimeout(function ()
							{
								swal({   title: "ERROR",   text: "Ha ocurrido un error mietras se cargaba el calendario de citas",   type: "error", confirmButtonClass: "btn-default" });
							},100);
			           	},
	    					color:'#777777',
					    editable:false
	    			},
					 /* Appointments same treatment (or same chachine)*/
					{
					 	type: 'POST',
					    url: '../modules/controllers/events_appointments-controller.php', // use the `url` property
					          
						data:
	    				{	
	                        "identityCard":identityCard,
	         				"branch":branch,
	         				"treatment":treatment,
	         				"bodyareas":bodyareas		
	    				},

	    				success: function(oper)
                    	{	
                    		$('#colForm2').html('<form type="POST" id="form2"><button type="submit" class="big-btn-purple">Asignar cita</button></form>');
                    			$("#form2").submit(function(e)
								{
								  	e.preventDefault();
								  	var end3;
								  	var aType=$("#aType-select-box").val();

					     			if ($("#okId").length==0 )
     			 					{
					  					//alert ('Debes ingresar una cedula de identidad válida');
					  					setTimeout(function ()
										{
											swal({   title: "Error",   text: "Debes ingresar una cédula de identidad válida",   type: "error", confirmButtonClass: "btn-default" });
										},100);

										$("#identityCard").focus();
					     				return false;
				 					}	

   									if (flag!=1)
								  	end3=end2;

								  	else
								  	end3=end;

								  	//AJAX Add Appointment to DB
					    			$.ajax(
					    			{
					    				url: "../modules/controllers/new_appointment-controller.php",
					    				type:"post",
					    				data:
					    				{	
					                        "identityCard":identityCard,
					         				"branch":branch,
					         				"start":start,
					         				"end":end3,
					         				"treatment":treatment,
	         								"bodyareas":bodyareas,
	         								"aType":aType	
					    				},

					                    success: function(oper)
					                    {	  
					                    	
					                    	$("#container2").empty();
					                    	$("#newAppointment").html(oper);
					                    	$("#newAppointment").append('<div class="row" style="margin-top:50px;"><div class="col-md-4 col-md-offset-4"><button class="big-btn-purple" id="anotherAppointment">Asignar otra cita</button></div></div>');
					                    	$("#anotherAppointment").click(function()
					                    	{ 
					                    		location.reload();

					                    	});

					                    },

					                    error: function() 
				    					{
				               			 	//alert('Ha ocurrido un error mientras se asignaba la cita');
				               			 	 setTimeout(function ()
											{
												swal({   title: "ERROR",   text: "Ha ocurrido un error mientras se asignaba la cita",   type: "error", confirmButtonClass: "btn-default" });
											},100);
				           			 	}
								  	}); //End AJAX Add Appointment to DB
								 });	//End form2	
                    		},

	    				error: function() 
	    				{
	               			//alert('Ha ocurrido un error mientras se cargaba el calendario de citas');
	               			setTimeout(function ()
							{
								swal({   title: "ERROR",   text: "Ha ocurrido un error mietras se cargaba el calendario de citas",   type: "error", confirmButtonClass: "btn-default" });
							},100);
			           	},

	            		color:'#7E3F96',
					    editable:false
					}], //end eventSources

					dayClick: function(date, allDay, jsEvent, view) 
					{
			            $('#calendar').fullCalendar('gotoDate', date);
			            $('#calendar').fullCalendar('changeView', 'agendaDay');
			        }
				});//end custom Calendar

				//Custom external events
				$('#external-events .fc-event').each(function() 
				{
					// store data so the calendar knows to render an event upon drop
					var view = $('#calendar').fullCalendar('getView');
					$(this).data('event',{
						title: $.trim($(this).text()), // use the element's text as the event title
			            color:'#F483CA',
			            eventBackgroundColor:'#F483CA', 
						stick: true,// maintain when user navigates (see docs on the renderEvent method)
						allDay:false,
						duration:appointmentTime,
						durationEditable:false
					
					});

					// make the event draggable using jQuery UI
					$(this).draggable(
					{
						zIndex: 999,
						revert: true,      // will cause the event to go back to its
						revertDuration: 0  //  original position after the drag
					});
				}); //end custom external-events
		
    		});	//end form new appointment
     	});

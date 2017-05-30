 $(function() {
    $('#nav li a').click(function() {
        $('#nav li').removeClass();
        $($(this).attr('href')).addClass('active');
    });
});

$(document).ready(function()
{	
	var startW = moment().startOf('week').format('YYYY-MM-DD');
	var endW   = moment().endOf('week').format('YYYY-MM-DD');

	//alert(startOfWeek+"-"+endOfWeek);
	$("#calendar").fullCalendar({

		defaultView:'agendaWeek',
		header: 
		{
			left: 'prev,next today',
			center: 'title',
			view:'agendaWeek',
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

		eventSources: [  
		/*All appointments by patient*/
		{
			type: 'POST',
			url: '../modules/controllers/home-manager-appointment-controller.php',	          
			data:
	    	{	      
	         	"startW":startW,
	         	"endW":endW		
	    	},

	    	success: function(oper)
           	{	
                    		
           	},

	    	error: function() 
	    	{  			
	            setTimeout(function ()
				{
					swal({   title: "ERROR",   text: "Ha ocurrido un error mietras se cargaba el calendario de citas",   type: "error", confirmButtonClass: "btn-default" });
					},100);
			    },
	    		color:'#7E3F96;',
				editable:false
	    	},
	    ]
		});
		});

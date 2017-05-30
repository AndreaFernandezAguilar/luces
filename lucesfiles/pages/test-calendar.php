<head>
	<?php 
		require_once ('../modules/class/connection.class.php');
        $conect = new Connection();
            
        if (!isset($_SESSION['id_role']) || !isset($_SESSION['id_user']))
        {    
               header('Location: ../../index.php?error=true');
        }


         elseif ($_SESSION['id_role']!=1 && $_SESSION['id_role']!=2)  
        {        
           header('Location: ../../index.php?error=true');
        }

		
		else
		include("../modules/sections/head.php");
	 ?>
	<script src="../js/alerts.js"></script>
    
  	<script type="text/javascript">

	$(document).ready(function() {
		var date = new Date();
 var d = date.getDate();
 var m = date.getMonth();
 var y = date.getFullYear();

 //alert ("el año es:"+y);

		$('#calendar').fullCalendar({
			
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			hiddenDays: [ 0 ],
			slotLabelFormat:'hh:mm a',
			allDaySlot:false,
			minTime:'08:00:00',
			maxTime:'19:00:00',
			slotDuration:'00:15:00',
			//businessHours :true,
			//weekends: false, // will hide Saturdays and Sundays
			timeFormat: 'hh:mm a',
			defaultDate: '2015-12-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
		    eventSources: [ "../modules/controllers/events_appoinments-controller.php" ],
		    eventSources: [

        // your event source
        {

    type: 'POST',
            url: '../modules/controllers/events_appointments-controller.php', // use the `url` property
            //rendering: 'background',
           			 color:'purple',
           			 editable:false
        }

        // any other sources...

    ],


			
			 dayClick: function(date, allDay, jsEvent, view) {
			 	//$(this);
            //console.log(view.name);
           // if (view.name === "month") {
                $('#calendar').fullCalendar('gotoDate', date);
                $('#calendar').fullCalendar('changeView', 'agendaDay');
            //}
        }
		});
		
	});


  	</script>
 
  




</head>

<body>

	<!--Header/Menu-->
	<?php 
		if ($_SESSION['id_role']==1)
		include("../modules/sections/header_manager.php");
				
		elseif($_SESSION['id_role']==2)
		include("../modules/sections/header_employee.php");
	?>
		

		<div class="container">
			
			<div class="row">
				<div class="col-md-8">
					<div id='calendar'></div>
				</div>
				
			</div>
		</div>
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
	
	</div><!--container principal-->


	<!--Footer-->

				<?php 
					include("../modules/sections/footer.php");
				 ?>		
		
	
	
</body>
</html>
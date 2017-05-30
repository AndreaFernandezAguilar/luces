/* Custom code */

$(document).ready(function dropdown() {
    $('#dropdown-toggle').dropdown();
});

$('#my-dropdown').hover(function hoverInsteadOfClick(){ 
	$('#my-dropdown-toggle', this).trigger('click'); 
});

$(document).ready(function(){
	$('.combobox').combobox();
});


/* Sumo select*/

$(document).ready(function () {
    $('#area-select-box').SumoSelect({
    	placeholder: 'Seleccione...',
    	selectAll: true,
    	selectAlltext: 'Seleccionar todas',
    	captionFormat: '{0} Seleccionadas'
    });
    $('#treatment-select-box').SumoSelect({
    	placeholder: 'Seleccione...'
    });
    $('#status-select-box').SumoSelect({
    	placeholder: 'Seleccione...'
    });
    $('#gender-select-box').SumoSelect({
    	placeholder: 'Seleccione...'
    });
    $('#state-select-box').SumoSelect({
    	placeholder: 'Seleccione...'
    });
    $('#city-select-box').SumoSelect({
    	placeholder: 'Seleccione...'
    });
    $('#num-pregnancies').SumoSelect({    });


    $('#testselect1').SumoSelect();


});

$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy"
	};

$(document).ready(function(){
    $.fn.datepicker.defaults.language = 'es';
});

$(document).ready(function () {
	$('#datepicker').datepicker({
	    format: 'dd/mm/yyyy'
	});
	$('#datepicker2').datepicker({
	    format: 'dd/mm/yyyy'
	});
});

$(document).ready(function(){
	   $('#name-span').text($('#name').val() + " " + $('#lastname').val());
	   $('#id-span').text($('#id').val());
	});
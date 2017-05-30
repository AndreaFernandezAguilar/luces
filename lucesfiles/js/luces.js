/* Custom code */

$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
});

$('.dropdown').hover(function(){ 
	$('.dropdown-toggle', this).trigger('click'); 
});

$(document)[0].getElementById('dropdown-menu1').onmouseover = function(){
	$(document)[0].getElementById('dropdown-toggle1').style.color = '#F483CA';
	$(document)[0].getElementById('dropdown-toggle1').style.backgroundColor = '#EBEBEB';
}

/* End of: Custom code */

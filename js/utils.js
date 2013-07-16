function toggleMenu() {

	var menuWidth = $('#menu').css('width').replace(/[^-\d\.]/g, '');
	if (menuWidth > 50) {
		// Hide the menu
		$('#menu').animate({width: '20px'}, 200);
		$('#menucontent').hide();
		$('.sourcecode').hide();

		// Change image
		$('#slidercontrols').attr('src', 'images/right-arrow.png');
		$('#slidercontrols').attr('onmouseover', "this.src='images/right-arrow-hover.png'");
		$('#slidercontrols').attr('onmouseout', "this.src='images/right-arrow.png'");
	}
	else {
		// Show menu
		$('#menu').animate({width: '200px'}, 200);
		$('#menucontent').show();
		$('.sourcecode').show();

		// Change image
		$('#slidercontrols').attr('src', 'images/left-arrow.png');
		$('#slidercontrols').attr('onmouseover', "this.src='images/left-arrow-hover.png'");
		$('#slidercontrols').attr('onmouseout', "this.src='images/left-arrow.png'");
	}

	return false;
}

function updateProgressBar() {						
	$('#szliderbar').css('width', pbValue+'%');
	pbValue++;
	if (pbValue > 100) pbValue = 0;
}
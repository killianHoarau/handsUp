jQuery(function($) {'use strict',

	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});


// Page compte
	var toggled = false;
	$('#btnEdit').on('click', function(){
		if (!toggled) {
			$("#inputLogin").css('display', 'block');
			$("#inputEmail").css('display', 'block');
			$("#btnSaveInfo").css('display', 'block');
			$("#btnCancelInfo").css('display', 'block');

			$('#login').hide();
			$('#email').hide();

			toggled = true;
		}else {
			$("#inputLogin").hide();
			$("#inputEmail").hide();
			$("#btnSaveInfo").hide();
			$("#btnCancelInfo").hide();

			$('#login').css('display', 'block');
			$('#email').css('display', 'block');

			toggled = false;
		}
	});

	$('#btnCancelInfo').on('click', function(){
		$("#inputLogin").hide();
		$("#inputEmail").hide();
		$("#btnSaveInfo").hide();
		$("#btnCancelInfo").hide();

		$('#login').css('display', 'block');
		$('#email').css('display', 'block');
	});


	//Initiat WOW JS
	new WOW().init();
});

jQuery(function($) {'use strict',

	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});


	$('#btnGoCours').click(function() {
		var idCours = $('#idCours').val();
		document.location.href = '../pages/cours.php?idCours='+idCours;
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

	$('#closeModif').click(function() {
		$('#contourForm').hide();
	});

	$('#btnValiderModif').click(function() {
		var libelle = $('#modifLibelle').val();
		var description = CKEDITOR.instances['editeur2'].getData();
		var idCoursModif = $('#idCoursModif').val();
		// console.log(description);

		$.ajax({
			url: "../ajax/confirmModifCompte.php",
			type: 'POST',
			async: true,
			data : {
				libelle : libelle,
				description : description,
				idCoursModif : idCoursModif,
				modifCours : true
				},
			success: function(code_html){
				$('#contourForm').hide();
				$('#listCours').html(code_html);
			}
		});
	});


	//Initiat WOW JS
	new WOW().init();
});

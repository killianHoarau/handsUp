$(document).ready(function(){
	$.ajax({
		url: "../ajax/getCours.php",
		type: 'POST',
		async: true,
		success: function(code_html)
		{
			$('#listCours').html(code_html);
		},
	});
	$('#formAddCours').hide();
});


$('#btnSaveInfo').click(function(){

	var login = document.getElementById('inputLogin');
	var email = document.getElementById("inputEmail");

	var valid = true;

	if(login.value.length === 0){
		login.style.border = "1px solid red";
		var valid = false;
	}
	if(email.value.length === 0){
		email.style.border = "1px solid red";
		var valid = false;
	}
	if(valid){
		$.ajax({
			url: "../ajax/confirmModifCompte.php",
			type: 'POST',
			async: true,
			data : {
				login : login.value,
				email : email.value
			},
			success : function(code_html){
				console.log(code_html);
				console.log("\"10\"");
				if(code_html == "\"10\"")	//si le login ou l'mail n'existe pas deja en base (valide = true et erreur = 0) : valide.erreur = "10"
					window.location.reload();
				else if(code_html == "\"1\"")		//si le login existe en base : erreur = "1"
				{
					$('#inputLogin').tooltip({
						title : "Login déja utilisé",
						placement: "bottom",
						trigger: "manual"
					});
					$('#inputLogin').tooltip('show');
				}
				else if(code_html == "\"2\"")		//si le login existe en base : erreur = "2"
				{
					$('#inputEmail').tooltip({
						title : "Email déja utilisé",
						placement: "bottom",
						trigger: "manual"
					});
					$('#inputEmail').tooltip('show');
				}
			},
		});
	}
});
var addCoursToggled = false;
// $('#btnAddCours').click(function(){
	// if(!addCoursToggled)	//Si le bandeau est caché, le click le déroule
	// {
		// $('#formAddCours').animate({
			// height: 'toggle'
		// });
		// addCoursToggled = true;
	// }
	// else		//Si le bandeau est déroulé, le bouton bntAddCours devient le bouton d'envoi du formulaire
	// {
		// var libelle = document.getElementsByName('libelle')[0];
		// var description = document.getElementsByName('addDescription')[0];
		
		// var valid = true;

		// if(libelle.value.length === 0){
			// libelle.style.border = "1px solid red";
			// var valid = false;
		// }
		// if(description.value.length === 0){
			// description.style.border = "1px solid red";
			// var valid = false;
		// }
		// if(valid)
		// {
			// var file = document.getElementsByName('file')[0];
			// $.ajax({
				// url: "../ajax/ajoutCours.php",
				// type: 'POST',
				// async: true,
				// data : {
					// libelle : libelle.value,
					// description : description.value,
					// file : file.value
				// },
				// success : function(code_html){
					// console.log(code_html);
				// }
				//alert("Valid");
			// });
		// }
	// }
// });

	function getfile(){	//Sert à la personnalisation d'un input file
		document.getElementById('hiddenfile').click();
	}
	function getvalue(){ //Sert à la personnalisation d'un input file
		document.getElementById('selectedfile').value=document.getElementById('hiddenfile').value;
	}
		
$('#annul').click(function(){
	if(!addCoursToggled)
	{
		var libelle = document.getElementsByName('libelle')[0].value;
		libelle = '';
		var addDescription = document.getElementsByName('addDescription')[0].value;
		addDescription = '';
		var hiddenfile = document.getElementById('hiddenfile').value;
		hiddenfile = '';
		$('#formAddCours').animate({
				height: 'toggle'
			});
		$("#annul").toggleClass('action-button oubli-button');
		$("#annul").html('Annuler');
		addCoursToggled = true;
	}
	else
	{
		$('#formAddCours').animate({
				height: 'toggle'
			});
		$("#annul").toggleClass('oubli-button action-button');
		$("#annul").html('Ajouter Cours')
		addCoursToggled = false;
	}
});
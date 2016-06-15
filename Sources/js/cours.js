$( document ).ready(function() {
    if (suivre) {
		$("#btnSuivreCour").hide();
		$(".cours-suivi").show();
    }else {
		$("#btnSuivreCour").show();
		$(".cours-suivi").hide();
    }
});

$('#btnSuivreCour').click(function() {
	var suivreCours = true;

	if (!droit) {
		document.location = 'inscriptionConnexion.php';
	} else if (droit == 1 || droit == 2) {
		alert('Vous devez être connectez en temps qu\'étudiant');
	}else {
		$.ajax({
			url: "../ajax/confirmSuivreCours.php",
			type: 'POST',
			async: true,
			data : {
				idCours : idCours,
				idUtilisateur : idUtilisateur,
				suivreCours : suivreCours
			},
			success : function(){
				$("#btnSuivreCour").hide();
				$(".cours-suivi").show();
			},
		});
	}
});

$("button[id^='btnVerouiller']").click(function() {
	var idQuestion = this.attributes["name"].value;
	var verrouille = document.getElementsByName('verrouille'+idQuestion)[0].value;
	var verrouillerQuestion = true;

	if (verrouille == 1) {
		verrouille = 0;
	}else {
		verrouille = 1;
	}
	$.ajax({
		url: "../ajax/confirmSuivreCours.php",
		type: 'POST',
		async: true,
		data : {
			idCours : idCours,
			idQuestion : idQuestion,
			verrouille : verrouille,
			verrouillerQuestion : verrouillerQuestion
		},
		success : function(code_html){
			$('#listQCM').html(code_html);
			// alert(code_html);
		},
	});

});

$("button[id^='btnRepondre']").click(function() {
	var idQuestion = this.attributes["name"].value;
	document.location = "reponseQCM.php?idQuestion="+idQuestion;

});

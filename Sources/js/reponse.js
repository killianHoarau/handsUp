$(document).ready(function(){
var compteur = -1;
compteur = setInterval(function(){ compteur++; }, 1000);

$('#btnValiderRetour').click(function() {
	var idCours = document.getElementsByName('idCours')[0].value;
	var reponses = document.getElementsByName('reponse');
	for (var i = 0; i < reponses.length; i++) {
		if (reponses[i].checked) {
			var idReponse = reponses[i].value;
		}
	}

	$.ajax({
		url: "../ajax/confirmReponse.php",
		type: 'POST',
		async: true,
		data : {
			idReponse : idReponse,
			compteur : compteur
		},
		success : function(code_html){
			document.location = "cours.php?idCours="+idCours;
		},
	});
});

$('#btnValiderSuivant').click(function() {
	var idCours = document.getElementsByName('idCours')[0].value;
	var idQuestion = document.getElementsByName('idQuestion')[0].value;
	var numQuestion = document.getElementsByName('numQuestion')[0].value;
	var reponses = document.getElementsByName('reponse');
	for (var i = 0; i < reponses.length; i++) {
		if (reponses[i].checked) {
			var idReponse = reponses[i].value;
		}
	}

	$.ajax({
		url: "../ajax/confirmReponse.php",
		type: 'POST',
		async: true,
		data : {
			idReponse : idReponse,
			compteur : compteur,
			idCours : idCours,
			idQuestion : idQuestion,
			numQuestion : numQuestion
		},
		success : function(code_html){
			if (code_html) {
				document.location = "reponseQCM.php?idQuestion="+code_html;
			}else{
				document.location = "cours.php?idCours="+idCours;
			}

		},
	});
});

$('#btnShowReponse').click(function() {
	var idQuestion = document.getElementsByName('idQuestion')[0].value;
	$.ajax({
		url: "../ajax/showReponse.php",
		type: 'POST',
		async: true,
		data : {
			idQuestion : idQuestion
		},
		success : function(code_html){
			$('#contentReponse').html(code_html);
		},
	});
});

});

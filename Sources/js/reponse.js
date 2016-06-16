$(document).ready(function(){
var compteur = -1;
compteur = setInterval(function(){ compteur++; }, 1000);

$('#btnValiderReponse').click(function() {
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
			console.log(code_html);
		},
	});
});

});

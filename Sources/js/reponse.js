$(document).ready(function(){
	var compteur = -1;
	compteur = setInterval(function(){ compteur++; }, 1000);
	$('#diagramme').hide();

	$('#btnValiderRetour').click(function() {
		var idCours = document.getElementsByName('idCours')[0].value;
		var idQuestion = document.getElementsByName('idQuestion')[0].value;
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
				idCours : idCours,
				idQuestion : idQuestion,
				compteur : compteur,
				adresseIP : adresseIP
			},
			success : function(code_html){
				// console.log(code_html);
				if (code_html == "verrouille") {
					$('.verrouille').show();
				}else if (code_html == "dejaRep") {
					$('.dejaRep').show();
				}else {
					document.location = "cours.php?idCours="+idCours;
				}

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
				numQuestion : numQuestion,
				adresseIP : adresseIP
			},
			success : function(code_html){
				if (code_html.indexOf('verrouille') != -1) {
					$('.verrouille').show();
					$('#myModal').hide();
					$('.modal-backdrop').hide();
				}else if (code_html.indexOf('dejaRep') != -1) {
					$('.verrouille').show();
					$('#myModal').hide();
					$('.modal-backdrop').hide();
				}else if (code_html && code_html.indexOf('verrouille') == -1 && code_html.indexOf('dejaRep') == -1) {
					document.location = "reponseQCM.php?idQuestion="+code_html;
				}else{
					document.location = "cours.php?idCours="+idCours;
				}

			},
		});
	});

	$('#btnShowReponse').click(function() {
		var idQuestion = document.getElementsByName('idQuestion')[0].value;
		console.log(idQuestion);
		$.ajax({
			url: "../ajax/showReponse.php",
			type: 'POST',
			async: true,
			data : {
				idQuestion : idQuestion
			},
			success : function(code_html){
				var retour = JSON.parse(code_html);
				var reponses = retour[0];
				// console.log(code_html);
				$('#contentReponse').hide();
				$('#bntReponse').hide();

				$('#reponse').show();
				$('#reponse').html('Réponse: '+ retour[1]);

				$('#diagramme').show();
				$('#diagramme').highcharts({
		            chart: {
		                plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
		                type: 'pie'
		            },
		            title: {
		                text: ''
		            },
		            tooltip: {
		                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		            },
		            plotOptions: {
		                pie: {
		                    allowPointSelect: true,
		                    cursor: 'pointer',
							dataLabels: {
			                    enabled: true,
			                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
			                    style: {
			                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			                    }
                			},
		                    showInLegend: true
		                }
		            },
		            series: [{
		                name: 'Parts',
		                colorByPoint: true,
		                data: (function () {
			                var data = [];

			                for(var j = 0; j < reponses.length; j += 1) {
			                    data.push([
			                        reponses[j].libelle,
			                        reponses[j].pourcentage
			                    ]);

			                }
			                return data;
						}())
		            }]
		        });
			},
		});
	});

});

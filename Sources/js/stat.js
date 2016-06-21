$(document).ready(function(){
	tabTemps = document.getElementsByName('grapheTemps');
	tabReponses = document.getElementsByName('grapheReponse');

	for (var i = 0; i < tabTemps.length; i++) {
	    // Create the chart
	    $("#"+tabTemps[i].id).highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Nombre de réponses en fonction du temps (s)'
	        },
	        xAxis: {
	            type: 'category',
				title: {
	                text: 'Temps en seconde'
	            }

	        },
	        yAxis: {
	            title: {
	                text: 'Nombre de réponses'
	            }

	        },
	        legend: {
	            enabled: false
	        },
	        plotOptions: {
	            series: {
	                borderWidth: 0,
	                dataLabels: {
	                    enabled: true,
	                    format: '{point.y:.1f}'
	                }
	            }
	        },

	        tooltip: {
	            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> réponses<br/>'
	        },

	        series: [{
	            name: 'Nombre de réponses',
	            colorByPoint: true,
	            data: [{
	                name: '0 - 10',
	                y: parseFloat(document.getElementsByName('befor10'+tabTemps[i].id)[0].value),
	                drilldown: '0 - 10'
	            }, {
	                name: '10 - 30',
	                y: parseFloat(document.getElementsByName('befor30'+tabTemps[i].id)[0].value),
	                drilldown: '10 - 30'
	            }, {
	                name: ' > 30',
	                y:  parseFloat(document.getElementsByName('after30'+tabTemps[i].id)[0].value),
	                drilldown: ' > 30'
	            }]
	        }]
	    });
	}

	retour = tab;

	for (var i = 0; i < tabReponses.length; i++) {
	    // Create the chart
		$("#"+tabReponses[i].id).highcharts({
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: 0,
	            plotShadow: false
	        },
	        title: {
	            text: 'Pourcentage<br>par<br>réponse',
	            align: 'center',
	            verticalAlign: 'middle',
	            y: 40
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                dataLabels: {
	                    enabled: true,
	                    distance: -50,
	                    style: {
	                        fontWeight: 'bold',
	                        color: 'white',
	                        textShadow: '0px 1px 2px black'
	                    }
	                },
	                startAngle: -90,
	                endAngle: 90,
	                center: ['50%', '75%']
	            }
	        },
	        series: [{
	            type: 'pie',
	            name: 'Réponses',
	            innerSize: '50%',
				data: (function () {
					var data = [];

					if (Object.keys(retour[i].reponses).length > 1) {
						for(var k = 0; k < Object.keys(retour[i].reponses).length - 1; k += 1) {
							data.push([
								retour[i].reponses[k].libelle,
								retour[i].reponses[k].pourcentage
							]);
						}
					}

					return data;
				}())
	        }]
	    });
	}
});

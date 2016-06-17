

<?php

session_start();

$idQuestion = $_POST['idQuestion'];
$date = Date("Y-m-d");

$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

$query = "SELECT * FROM reponse WHERE idQuestion = $idQuestion AND bonne = 1;";
$result = $link->query($query);
$reponse = $result->fetch_assoc();


$query = "SELECT count(*) as 'nbr' FROM repondre WHERE date = '$date' AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) ;";
$result = $link->query($query);
$bnrReponse = $result->fetch_assoc();


$query = "SELECT count(*) as 'nbr' FROM repondre WHERE date = '$date' AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion AND bonne = 1);";
$result = $link->query($query);
$bnrReponseBonne = $result->fetch_assoc();




?>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>



<script type="text/javascript">
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Browser market shares January, 2015 to May, 2015'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Microsoft Internet Explorer',
                    y: 56.33
                }, {
                    name: 'Chrome',
                    y: 24.03,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Firefox',
                    y: 10.38
                }, {
                    name: 'Safari',
                    y: 4.77
                }, {
                    name: 'Opera',
                    y: 0.91
                }, {
                    name: 'Proprietary or Undetectable',
                    y: 0.2
                }]
            }]
        });
    });
});
</script>



<?php

session_start();

$idQuestion = $_POST['idQuestion'];
$date = Date("Y-m-d");

$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

$query = "SELECT * FROM reponse WHERE idQuestion = $idQuestion AND bonne = 1;";
$result = $link->query($query);
$bonneReponse = $result->fetch_assoc();


$query = "SELECT count(*) as 'nbr' FROM repondre WHERE date = '$date' AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) ;";
$result = $link->query($query);
$bnrReponseTotal = $result->fetch_assoc();


$query = "SELECT idReponse, libelle, count(*) as 'nbr' FROM repondre, reponse WHERE repondre.idReponse = reponse.id AND date = '$date' AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) GROUP BY idReponse;";
$result = $link->query($query);

$reponses = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$reponses[$i]['id'] = $row['idReponse'];
		$reponses[$i]['libelle'] = $row['libelle'];
		$reponses[$i]['nbrReponse'] = $row['nbr'];
		$reponses[$i]['pourcentage'] = ($row['nbr'] * 100) / $bnrReponseTotal["nbr"];
		$i++;
	}
}

$retour = array($reponses, $bonneReponse["libelle"], $bnrReponseTotal["nbr"]);

// echo $retour;
echo json_encode($retour);
?>

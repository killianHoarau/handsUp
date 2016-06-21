<?php

session_start();

//Variables
$idQuestion = $_POST['idQuestion'];
$date = Date("Y-m-d");

//Connexion BDD
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

//Récupération de la bonne réponse pour cette question
$query = "SELECT * FROM reponse WHERE idQuestion = $idQuestion AND bonne = 1;";
$result = $link->query($query);
$bonneReponse = $result->fetch_assoc();

//Récupération du nombre de réponses totales données à cette question, ce jour
$query = "SELECT count(*) as 'nbr' FROM repondre WHERE date = '$date' AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) ;";
$result = $link->query($query);
$bnrReponseTotal = $result->fetch_assoc();

//Récupération de chaque réponse donnée + calcul du pourcentage / reponses
$query = "SELECT idReponse, libelle, count(*) as 'nbr' FROM repondre, reponse WHERE repondre.idReponse = reponse.id AND date = '$date' AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) GROUP BY idReponse;";
$result = $link->query($query);

$reponses = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$reponses[$i]['id'] = $row['idReponse'];
		$reponses[$i]['libelle'] = utf8_encode($row['libelle']);
		$reponses[$i]['nbrReponse'] = $row['nbr'];
		$reponses[$i]['pourcentage'] = ($row['nbr'] * 100) / $bnrReponseTotal["nbr"];
		$i++;
	}
}

$retour = array($reponses, $bonneReponse["libelle"], $bnrReponseTotal["nbr"]);
echo json_encode($retour);


//Vérouille le QCM
$query = "UPDATE question SET verrouille = 1 WHERE id = $idQuestion";
$result = $link->query($query);
?>

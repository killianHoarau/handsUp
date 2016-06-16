<?php
$idQuestion = $_GET["idQuestion"];

// Récupération de la question
$query = "SELECT * FROM question WHERE id = $idQuestion";
$result = $link->query($query);
$question = $result->fetch_assoc();

//Récupération des réponses
$query = "SELECT * FROM reponse WHERE idQuestion = $idQuestion";
$result = $link->query($query);

$reponses = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$reponses[$i]['id'] = $row['id'];
		$reponses[$i]['libelle'] = utf8_encode($row['libelle']);
		$reponses[$i]['bonne'] = $row['bonne'];
		$reponses[$i]['nomImage'] = $row['nomImage'];

	$i++;
	}
}

$nbrBonneReponse = 0;

foreach ($reponses as $reponse) {
	if ($reponse["bonne"] == 1) {
		$nbrBonneReponse++;
	}
}

?>

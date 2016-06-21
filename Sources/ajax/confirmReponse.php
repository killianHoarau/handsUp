<?php

session_start();
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

if ($_SESSION['id']) {
	$idUtilisateur = $_SESSION['id'];
}

$numQuestion = $_POST["numQuestion"];
$idQuestion = $_POST["idQuestion"];
$idCours = $_POST["idCours"];
$idReponse = $_POST['idReponse'];
$compteur = $_POST['compteur'];
$adresseIP = $_POST["adresseIP"];
$date = Date("Y-m-d");
$dejaRep = false;


//Test deja rep
$query = "SELECT * FROM repondre WHERE idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) AND date = '$date' AND adresseIP = '$adresseIP'";
$result = $link->query($query);
if ($result->num_rows > 0) {
	$dejaRep = true;
}


$query = "SELECT * FROM question WHERE idCours = $idCours";
$result = $link->query($query);

$questions = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$questions[$i]['id'] = $row['id'];
		$questions[$i]['libelle'] = utf8_encode($row['libelle']);
		$questions[$i]['verrouille'] = $row['verrouille'];
		$questions[$i]['num'] = $row['numero'];

		if ($row['id'] == $idQuestion) {
			$verrouille = $row['verrouille'];
		}
	$i++;
	}
}

//Recherche de la question suivante
foreach ($questions as $question) {
	if ($question['num'] == ($numQuestion + 1)) {
		if ($question['verrouille'] == 0) {
			// echo $question['id'];
		}
	}
}


if ($verrouille) {
	echo "verrouille";
}elseif ($dejaRep) {
	echo "dejaRep";
}else {
	//Insertion de la réponse en base
	if ($idUtilisateur) {
		$query = "INSERT INTO repondre VALUES ('$adresseIP', $idUtilisateur, $idReponse, '$date', $compteur);";
		$result = $link->query($query);
	}else {
		$query = "INSERT INTO repondre (adresseIP, idReponse, date, temps) VALUES ('$adresseIP', $idReponse, '$date', $compteur);";
		$result = $link->query($query);
	}

}


?>

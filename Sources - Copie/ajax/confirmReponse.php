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
$date = Date("Y-m-d");


$query = "INSERT INTO repondre VALUES ($idUtilisateur, $idReponse, '$date', $compteur);";
$result = $link->query($query);


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

	$i++;
	}
}

foreach ($questions as $question) {
	if ($question['num'] == ($numQuestion + 1)) {
		if ($question['verrouille'] == 0) {
			echo $question['id'];
		}
	}
}

?>

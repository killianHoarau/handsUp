<?php
session_start();

$idCours = $_POST['idCours'];
$libelleQuestion = $_POST['question'];
$tabReponses = $_POST['tabReponses'];


$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

//Recherche du numéro
$query = "SELECT count(*) as 'nbr' FROM question WHERE idCours = $idCours;";
$result = $link->query($query);
$row = $result->fetch_assoc();
$nbrQuestion = $row['nbr'] + 1;

$query = "INSERT INTO question (libelle, idCours, numero) VALUES ('$libelleQuestion', $idCours, $nbrQuestion);";

$result = $link->query($query);

$query = "SELECT id FROM question WHERE libelle = '$libelleQuestion' AND idCours = $idCours";
$result = $link->query($query);
$row = $result->fetch_assoc();



for($i=0; $i<count($tabReponses); $i++){
	//die(var_dump($tabReponses[$i][1]));
	$libelle = $tabReponses[$i][0];
	$bonne = $tabReponses[$i][1];
	$idQuestion = $row['id'];
	$query = "INSERT INTO reponse (libelle, bonne, idQuestion) VALUES ('$libelle', $bonne, $idQuestion);";
	$result = $link->query($query);
}
?>

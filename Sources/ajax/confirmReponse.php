<?php

session_start();

if ($_SESSION['id']) {
	$idUtilisateur = $_SESSION['id'];
}

$idReponse = $_POST['idReponse'];
$compteur = $_POST['compteur'];
$date = Date("Y-m-d");


$query = "INSERT INTO reponse VALUES ($idUtilisateur, $idReponse, $date, $compteur);";
// die(var_dump($query));
$result = $link->query($query);

?>

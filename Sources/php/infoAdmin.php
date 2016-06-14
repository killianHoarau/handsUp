<?php
session_start();
$id = $_SESSION["id"];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

$query = "SELECT * FROM utilisateur";
$result = $link->query($query);

$utilisateurs = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$utilisateurs[$i]['id'] = $row['id'];
		$utilisateurs[$i]['login'] = utf8_encode($row['login']);
		$utilisateurs[$i]['motDePasse'] = utf8_encode($row['motDePasse']);
		$utilisateurs[$i]['statut'] = $row['statut'];
		$utilisateurs[$i]['valide'] = $row['valide'];
	$i++;
	}
}

$query = "SELECT * FROM code_statut";
$result = $link->query($query);

$codes = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$codes[$i]['code'] = $row['code'];
		$codes[$i]['statut'] = $row['statut'];
	$i++;
	}
}


?>

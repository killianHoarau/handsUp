<?php
session_start();
$id = $_SESSION["id"];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
$query = "SELECT cours.id as 'idCours', libelle, description, login as 'loginEnseignant'  FROM cours, suivre_cours, utilisateur WHERE cours.id = suivre_cours.idCours AND utilisateur.id = cours.idEnseignant AND suivre_cours.idUtilisateur = '$id';";
// die(var_dump($query));
$cours = array(array());
$i = 0;

$result = $link->query($query);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$cours[$i]['idCours'] = $row['idCours'];
		$cours[$i]['libelleCours'] = utf8_encode($row['libelle']);
		$cours[$i]['descriptionCours'] = utf8_encode($row['description']);
		$cours[$i]['loginEnseignant'] = $row['loginEnseignant'];
	$i++;
	}
}



?>

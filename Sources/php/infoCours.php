<?php
$idCours = $_GET["idCours"];
$suivre = false;

//Contenu du cours
$query = "SELECT * FROM cours WHERE id = $idCours";
$result = $link->query($query);
$cour = $result->fetch_assoc();


//Etudiant qui suivent ce cours
$query = "SELECT * FROM suivre_cours WHERE idCours = $idCours";
$result = $link->query($query);

$utilisateurs = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$utilisateurs[$i]['id'] = $row['idUtilisateur'];
		if ($row['idUtilisateur'] == $_SESSION['id']) {
			$suivre = true;
		}
	$i++;
	}
}


//QCM du cours
$query = "SELECT * FROM question WHERE idCours = $idCours";
$result = $link->query($query);

$questions = array(array());
$i = 0;

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		$questions[$i]['id'] = $row['id'];
		$questions[$i]['libelle'] = utf8_encode($row['libelle']);
		$questions[$i]['verrouille'] = $row['verrouille'];
		$questions[$i]['num'] = $i+1;

	$i++;
	}
}

?>

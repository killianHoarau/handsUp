<?php

$idCours = $_GET["idCours"];

//Contenu du cours
$query = "SELECT * FROM cours WHERE id = $idCours";
$result = $link->query($query);
$cour = $result->fetch_assoc();


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
		$questions[$i]['num'] =$row['numero'];



		//NOMBRE DE REPONSE PAR TEMPS

		$idQuestion = $row['id'];

		// inférieur à 10
		$query = "SELECT count(*) as 'nbr' FROM repondre WHERE idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) AND temps between 0 and 10";
		$resultNBR = $link->query($query);
		$resultNBR = $resultNBR->fetch_assoc();
		$questions[$i]['befor10'] = $resultNBR['nbr'];
		// entre 10 ET 30
		$query = "SELECT count(*) as 'nbr' FROM repondre WHERE idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) AND temps between 11 and 30";
		$resultNBR = $link->query($query);
		$resultNBR = $resultNBR->fetch_assoc();
		$questions[$i]['befor30'] = $resultNBR['nbr'];
		// supérieur à 30
		$query = "SELECT count(*) as 'nbr' FROM repondre WHERE idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) AND temps > 30";
		$resultNBR = $link->query($query);
		$resultNBR = $resultNBR->fetch_assoc();
		$questions[$i]['after30'] = $resultNBR['nbr'];


		//POURCENTAGE DE REPONSES

		$questions[$i]['reponses'] = array();

		$query = "SELECT count(*) as 'nbr' FROM repondre WHERE idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) ;";
		$resultRepTotal = $link->query($query);
		$resultRepTotal = $resultRepTotal->fetch_assoc();
		$questions[$i]['reponses']['bnrReponseTotal'] = $resultRepTotal['nbr'];

		if ($questions[$i]['reponses']['bnrReponseTotal'] > 0) {
			$query = "SELECT idReponse, libelle, count(*) as 'nbr' FROM repondre, reponse WHERE repondre.idReponse = reponse.id AND idReponse IN (SELECT id FROM reponse WHERE idQuestion = $idQuestion) GROUP BY idReponse;";
			$resultReponses = $link->query($query);

			$reponses = array(array());
			$j = 0;

			if ($resultReponses->num_rows > 0) {
				while($row = $resultReponses->fetch_assoc()){
					$questions[$i]['reponses'][$j]['id'] = $row['idReponse'];
					$questions[$i]['reponses'][$j]['libelle'] = utf8_encode($row['libelle']);
					$questions[$i]['reponses'][$j]['nbrReponse'] = $row['nbr'];
					$questions[$i]['reponses'][$j]['pourcentage'] = ($row['nbr'] * 100) / $questions[$i]['reponses']['bnrReponseTotal'];
					$j++;
				}
			}
		}


	$i++;
	}
}

?>

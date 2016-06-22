<?php
session_start();
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');

//MODIFICATION DU COMPTE
if (!$_POST['modifCours']) {
	$id = $_SESSION["id"];
	$login = $_POST['login'];
	$email = $_POST['email'];

	$valide = true;
	$erreur = 0;

	//Existence du login en base
	if(!empty($login)){
		$query = "SELECT * FROM utilisateur WHERE login = '$login';";
		$result = $link->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($_SESSION["id"] != $row['id']) {
				$valide = false;
				$erreur = 1;
			}
		}
		$result->mysqli_free_result;
	}

	//Existence de l'email en base
	if(!empty($email)){
		$query = "SELECT * FROM utilisateur WHERE email = '$email';";
		$result = $link->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($_SESSION["id"] != $row['id']){
				$valide = false;
				$erreur = 2;
			}
		}
		$result->mysqli_free_result;
	}


	if($valide)
	{
		//Modification en base
		$query = "UPDATE utilisateur SET login = '$login', email = '$email' WHERE id = $id";
		$result = $link->query($query);

		$_SESSION["login"] = $login;
		$_SESSION["email"] = $email;
		$_SESSION["id"] = $id;

	}
	echo json_encode($valide.$erreur);
}



//MODIFICATION DU COURS
if ($_POST['modifCours']) {
	$idCours = $_POST['idCoursModif'];
	$libelle = $_POST['libelle'];
	$description = $_POST['description'];

	$query = "UPDATE cours SET libelle = '$libelle', description = '$description' WHERE id = $idCours";
	$result = $link->query($query);

	include('getCours.php');
}


?>

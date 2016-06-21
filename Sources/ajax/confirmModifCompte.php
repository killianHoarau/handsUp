<?php
session_start();

$id = $_SESSION["id"];
$login = $_POST['login'];
$email = $_POST['email'];

$valide = true;
$erreur = 0;
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
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

?>

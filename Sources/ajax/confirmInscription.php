<?php
$login = $_POST['login'];
$mdp = $_POST['mdp'];
// $mdp = hash("sha256",$_POST['mdp']);
$cmdp = $_POST['cmdp'];
// $cmdp = hash("sha256",$_POST['$cmdp']);
$email = $_POST['email'];
$code = $_POST['code'];

$valide = true;

$link = new mysqli('localhost', 'root', 'mysql', 'handsup');		//CONNEXION

//Existence du login en base
if(!empty($login)){
	$upperLogin = strtoupper($login);
	$lowerLogin = strtolower($login);

	$query = "SELECT * FROM utilisateur WHERE login = '$upperLogin' OR login = '$lowerLogin';";
	$result = $link->query($query);
	if ($result->num_rows > 0) {
		?>
		<span class='popupW col-lg-12'><?php echo "Ce login est déja utilisé"; ?> </span><br>
		<?php
		$valide = false;
	}
	if ($result->num_rows > 0) $result->mysqli_free_result;
}


//Existence de l'email en base
if(!empty($email) && ($valide)){
	$query = "SELECT * FROM utilisateur WHERE email = '$email';";
	$result = $link->query($query);
	if ($result->num_rows > 0) {
		?>
		<span class='popupW col-lg-12'><?php echo "Cet email est déja utilisé"; ?></span><br>
		<?php
		$valide = false;
	}
	if ($result->num_rows > 0)$result->mysqli_free_result;
}

//comparaison des mots de passe
if(!empty($mdp) && isset($cmdp) && ($valide)){
	if($mdp!=$cmdp)
	{
		?>
		<span class='popupW col-lg-12'><?php echo "Les mots de passe ne correspondent pas"; ?></span><br>
		<?php
		$valide = false;
	}else {
		$mdp = hash("sha256",$mdp);
		$cmdp = hash("sha256",$cmdp);
	}
}

//Existence du code en base
if(!empty($code) && ($valide)){
	$query = "SELECT * FROM code_statut WHERE code = '$code' AND utilise = 0;";
	$result = $link->query($query);
	if ($result->num_rows == 0) {
		?>
		<span class='popupW col-lg-12'><?php echo "Ce code n'est pas valide. Contactez l'administration"; ?></span><br>
		<?php
		$valide = false;
	}
	if ($result->num_rows>0)$result->mysqli_free_result;
}

//Si on passe a travers tous les test
if($valide)
{
	//R�cup�ration du statut
	$query = "SELECT statut from code_statut where code = '$code';";
	$result = $link->query($query);
	$row = $result->fetch_assoc();
	$statut = $row['statut'];

	include('../php/mailInscription.php');

	if (!$error) {
		echo "<span class='popup col-lg-12'>Un Mail de confirmation vous a été envoyé</span>";
		//Insertion en base
		$query = "INSERT INTO utilisateur (login,motDePasse, statut, valide, email) VALUES ('$login', '$mdp', $statut, 0, '$email');";
		$result = $link->query($query);

		$query = "UPDATE code_statut SET utilise = 1 WHERE code = $code";
		$result = $link->query($query);
	}else {
		echo "<span class='popupW col-lg-12'>Le mail n'est pas valide</span>";
	}

}
?>

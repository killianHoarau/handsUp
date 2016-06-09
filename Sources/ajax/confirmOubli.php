<?php
ini_set("SMTP", "smtp.gmail.com");
ini_set("smtp_port", 465 );

$login = $_POST['login'];
$mdp = $_POST['mdp'];
$cmdp = $_POST['cmdp'];
$email = $_POST['email'];
$code = $_POST['code'];

$valide = true;

$link = new mysqli('localhost', 'root', '', 'handsup');

//Existence du login en base
if(!empty($login)){
	$query = "SELECT * FROM utilisateur WHERE login = '$login';";
	$result = $link->query($query);
	if ($result->num_rows > 0) {
		?>
		<span>Ce login est déja utilisé</span><br>
		<?php
		$valide = false;
	}
	$result->mysqli_free_result;
}


//Existence de l'email en base
if(!empty($email)){
	$query = "SELECT * FROM utilisateur WHERE email = '$email';";
	$result = $link->query($query);
	if ($result->num_rows > 0) {
		?>
		<span>Cet email est déja utilisé</span><br>
		<?php
		$valide = false;
	}
	$result->mysqli_free_result;
}

//comparaison des mots de passe
if(!empty($mdp) && isset($cmdp)){
	if($mdp!=$cmdp)
	{
		?>
		<span>Les mots de passe ne correspondent pas</span><br>
		<?php
		$valide = false;
	}
}

//Existence du code en base
if(!empty($code)){
	$query = "SELECT * FROM code_statut WHERE code = '$code';";
	$result = $link->query($query);
	if ($result->num_rows == 0) {
		?>
		<span>Ce code n'est pas valide. Contactez l'administration</span><br>
		<?php
		$valide = false;
	}
	$result->mysqli_free_result;
}

//Si on passe a travers tous les test
if($valide)
{
	//Récupération du statut
	$query = "SELECT statut from code_statut where code = '$code';";
	$result = $link->query($query);
	$row = $result->fetch_assoc();
	$statut = $row['statut'];
	
	//Insertion en base
	$query = "INSERT INTO utilisateur (login,motDePasse, statut, valide, email) VALUES ('$login', '$mdp', $statut, 1, '$email');";
	$result = $link->query($query);
	
	echo "Vous êtes bien inscris";
	//ok cest bon
	//Envoie mail de confirmation
	//$destinataire = $email;
	//$sujet = "Confirmez votre inscription à HandsUp !";
	//$message = "<span>Veuillez cliquer sur le lien suivant pour confirmer votre inscription <a href='http://localhost:8080/handsup/Sources/pages/validerInscription.php?login=$login'>en cliquant ici</a></span>";
	//mail($destinataire, $sujet, $message);
}
?>
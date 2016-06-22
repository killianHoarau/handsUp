<?php
	session_start();
	$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
	$idConversation = $_POST['id'];
	$id = $_SESSION['id'];
	$query = "SELECT titre, idEmetteur, idDestinataire FROM message_prive WHERE id = (SELECT MAX(id) FROM message_prive WHERE idConversation = $idConversation);";
	$result = $link->query($query);
	$row = $result->fetch_assoc();
	$tab = array();
	$tab['titre'] = $row['titre'];
	if($id != $row['idEmetteur'])
		$tab['idEmetteur'] = $row['idEmetteur'];
	else
		$tab['idEmetteur'] = $row['idDestinataire'];
	$retour = json_encode($tab);
	echo $retour;
?>
<?php 
	session_start();
	$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
	$idConversation = $_POST['id'];
	$id = $_SESSION['id'];
	$query = "UPDATE message_prive SET lu = 1 WHERE idConversation = $idConversation and idDestinataire = $id;";
	$result = $link->query($query);
?>
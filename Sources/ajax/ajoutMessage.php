<?php
	//Recupère toutes les conversations de l'utilisateur connécté
	$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
	$id = $_POST['id'];
	$titre = $_POST['titre'];
	$contenu = $_POST['contenu'];
	$tabDestinataire = $_POST['tabDestinataire'];
	$date = date("Y-m-d");
	
	for($i=0; $i<count($tabDestinataire); $i++)
	{
		$idDestinataire = $tabDestinataire[$i];
		$query = "SELECT id FROM conversation WHERE (utilisateur0 = $id AND utilisateur1 = $idDestinataire) or (utilisateur0 = $idDestinataire AND utilisateur1 = $id);";
		$result = $link->query($query);
		$row = $result->fetch_assoc();
		if($result->num_rows > 0)	//Si la conversation exist deja en base on recupere son id et on INSERT un message qui possède cet id Conversation + UPDATE de la date de la conversation
		{
			$idConversation = $row['id'];
			$insertMessage = "INSERT INTO message_prive (`idEmetteur`, `idDestinataire`, `titre`, `contenu`, `date`, `lu`, `idConversation`) VALUES ($id, $idDestinataire, '$titre', '$contenu', '$date', 0, $idConversation);";
			$resInsert = $link->query($insertMessage);
			$updateConversation = "UPDATE conversation set date = '$date' WHERE id = $idConversation;";
			$link->query($updateConversation);
		}
		else	//Sinon la conversation est créée et INSERT du message sur ce nouvel idConversation.
		{
			$insertConversation = "INSERT INTO conversation (`utilisateur0`, `utilisateur1`, `date`) values ($id, $idDestinataire, '$date');";
			$link->query($insertConversation);
			
			$selectMaxConversation = "SELECT MAX(id) FROM conversation;";
			$result = $link->query($selectMaxConversation);
			$ligne = $result->fetch_assoc();
			$idConversation = $ligne['MAX(id)'];
			$insertMessage = "INSERT INTO message_prive (`idEmetteur`, `idDestinataire`, `titre`, `contenu`, `date`, `lu`, `idConversation`) VALUES ($id, $idDestinataire, '$titre', '$contenu', '$date', 0, $idConversation);";
			// echo $insertMessage;
			$link->query($insertMessage);
		}
	}
	
	
	
	
	//-----------------------------Affichage des conversations mise a jour--------------------------------------//
	$query = "SELECT c.*, u.login, u.id as idCorrespondant FROM conversation c, utilisateur u WHERE (c.utilisateur0 = $id or c.utilisateur1 = $id) AND u.id != $id AND (u.id = c.utilisateur0 or u.id = c.utilisateur1) ORDER BY date DESC;";
	$result = $link->query($query);
			while($row=$result->fetch_assoc())	//Pour chaque Conversation
			{  
				$idConversation = $row['id'];
				$query = "SELECT m.*, u1.login as Emetteur, u2.login as Destinataire FROM message_prive m, utilisateur u1, utilisateur u2 WHERE idConversation = $idConversation AND m.idEmetteur = u1.id AND m.idDestinataire = u2.id ORDER BY date DESC;";
				$res = $link->query($query);
			?>	<div name="conversation" class="row"> 
					<div name="correspondant">
						<span><?php echo $row['login']; ?></span>
					</div>
					<div name="messages" class="row">
<?php				while($messages = $res->fetch_assoc())	//Et pour chaque message
					{ ?>
							<span class="col-md-6 col-xs-12"><?php echo "Emetteur : ".$messages['Emetteur']; ?></span>
							<span class="col-md-6 col-xs-12"><?php echo "Destinataire : ".$messages['Destinataire']; ?></span>
							<span class="col-md-12 col-xs-12"><?php echo $messages['titre']; ?></span>
							<span class="col-md-12 col-xs-12"><?php echo $messages['contenu']; ?></span>
<?php				} ?>
					</div>
				</div>
<?php		} ?>
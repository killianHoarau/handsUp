<?php
	//Recupère toutes les conversations de l'utilisateur connécté
	$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
	$id = $_POST['id'];
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
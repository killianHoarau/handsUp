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
				$query = "SELECT m.*, u1.login as Emetteur, u2.login as Destinataire FROM message_prive m, utilisateur u1, utilisateur u2 WHERE idConversation = $idConversation AND m.idEmetteur = u1.id AND m.idDestinataire = u2.id ORDER BY date DESC, m.id DESC;";
				$res = $link->query($query);
			?>	
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dc-box">
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12 dc-single-product-configuration" name="trCours" id="<?php echo $row['id'];?>">
					<?php echo $row['login'];?>
					<i data-toggle="modal" data-target="#myModal" name="confSupr" id="confSupr<?php echo $row['id'];?>" class="fa fa-trash-o poubelle fa-2x"  aria-hidden="true"></i>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="dc-config-panel" name="trInfos<?php echo $row['id'];?>">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 contentMessage" id="mess">
<?php				while($messages = $res->fetch_assoc())	//Et pour chaque message
					{ ?>
						<ol class="chat">
							<div class="day"><time><?php echo date("d-m-Y", strtotime($messages['date'])); ?></time></div>
									<li class="<?php if($_SESSION['login']==$messages['Emetteur']) echo "self"; 
													 else echo "other";
												?>">
									<div class="msg">
										<h5><?php echo $messages['titre']; ?>:</h5>
										<p><?php echo $messages['contenu']; ?></p>
									</div>
								</li>
							</ol>
<?php				} ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 msform">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<button id="envoyerMessage" name="btnRepondre" id="<?php echo "eeeé".$row['id']; ?>" class="next action-button">Repondre</button>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">						
							<button class="next oubli-button" name="btnFermer">Fermer</button>
						</div>
					</div>
				</div>
			</div>
<?php		} ?>
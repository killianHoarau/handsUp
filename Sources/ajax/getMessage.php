<?php
	session_start();
	//Recupère toutes les conversations de l'utilisateur connécté
	$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
	$id = $_POST['id'];
	$query = "SELECT c.*, u.login, u.id as idCorrespondant FROM conversation c, utilisateur u WHERE (c.utilisateur0 = $id or c.utilisateur1 = $id) AND u.id != $id AND (u.id = c.utilisateur0 or u.id = c.utilisateur1) ORDER BY date DESC;";
	$result = $link->query($query);
			while($row=$result->fetch_assoc())	//Pour chaque Conversation
			{  
				$idConversation = $row['id'];
				$query = "SELECT m.*, u1.login as Emetteur, u2.login as Destinataire FROM message_prive m, utilisateur u1, utilisateur u2 WHERE idConversation = $idConversation AND m.idEmetteur = u1.id AND m.idDestinataire = u2.id ORDER BY date ASC;";
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

<script type="text/javascript">
$(document).ready(function(){	
	$("div[name^='trInfos']").hide(); //Cache toutes les div dont le name commence par 'trInfos'
});

$("div[name='trCours']").click(function(){
	var id = this.id;
	if ($('div[name="trInfos'+id+'"]').is(":visible")){
		element = document.getElementById('mess');
		element.scrollTop = element.scrollHeight;
		$('div[name="trInfos'+id+'"]').slideUp(1000);
	}else{
		element = document.getElementById('mess');
		element.scrollTop = element.scrollHeight;
		$('div[name="trInfos'+id+'"]').slideDown(1000);
	}
});

$("button[name='btnRepondre']").click(function(){
	$("div[name^='trInfos']").hide();
	$('#newMessage').show();
	document.getElementById("newObject").value="fuck";
});
</script>
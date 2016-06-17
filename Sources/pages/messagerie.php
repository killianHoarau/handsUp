<?php
    $title="Messagerie";
    include("header.php");
	$login = $_SESSION['login'];
	$id = $_SESSION['id'];
	$query = "SELECT message.id, message.titre, message.contenu, message.date, message.reponse, message.lu, u1.login as 'emetteur', u2.login as 'destinataire' FROM message, utilisateur u1, utilisateur u2 WHERE message.idEmetteur = u1.id AND message.idDestinataire = u2.id AND idEmetteur = $id OR idDestinataire = $id;";
	//echo $query;
	$result = $link->query($query);
?>
<section id="feature">
	<div class="container">
		<div class="center wow fadeInDown animated">
			<h2>Vos messages</h2>
<?php
$tabId = array();
$tabEmetteur = array();
$tabTitre = array();
// $tabDate = array();
			while($row=$result->fetch_assoc())
			{
				$tabId[] = $row['id'];
				$tabEmetteur[] = $row['emetteur'];
				$tabTitre[] = $row['titre'];
				if($row['lu']==0)
				{?>	<!-- Changer la classe de la div si le message n'est pas lu (genre txt en gras) -->
					<div id=<?php echo $row['id']; ?> class="nonLu" name="Message">
<?php 			} else{?>
					<div id=<?php echo $row['id']; ?> class="Lu" name="Message">
<?php			}?>	
					<!-- Champs VISIBLES -->
					<span><?php echo $row['emetteur']; ?></span>
					<span><?php echo $row['titre']; ?></span>
					<span><?php echo $row['date']; ?></span>
					<!-- Champs CACHES -->
					<input type="hidden" value="<?php echo $row['emetteur']; ?>" name="<?php echo $row['id']; ?>emetteur" />
					<input type="hidden" value="<?php echo $row['titre']; ?>" name="<?php echo $row['id']; ?>titre" />
					<input type="hidden" value="<?php echo $row['destinataire']; ?>" name="<?php echo $row['id']; ?>destinataire" />
				</div>
<?php		} ?>
		</div>
	</div>
	
	<div id="form">
		<input type="text" value="<?php echo $row['emmetteur']; ?>" name="reponseTo">
		<input type="text" value="<?php echo "Re : ".$row['titre']; ?>" name="reponseTitre">
		
	</div>
	
</section>

<?php
	include("footer.php");
?>
<script>
	$("div[name='Message']").click(function(){
		var id = this.id;
		
		$.ajax({
			url: "../ajax/repondreMessage.php",
			type: 'POST',
			async: true,
			data : {
				login : login.value,
				email : email.value
			},
			success : function(code_html){
			}
	});
</script>
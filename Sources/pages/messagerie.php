<?php
    $title="Messagerie";
    include("header.php");
	$login = $_SESSION['login'];
	$id = $_SESSION['id'];
	$query = "SELECT distinct id FROM conversation WHERE utilisateur0 = $id or utilisateur1 = $id";
	//echo $query;
	$result = $link->query($query);
?>
<section id="feature">
	<div class="container">
		<div class="center wow fadeInDown animated">
			<h2>Vos messages</h2>
<?php
			while($row=$result->fetch_assoc())	//Pour chaque Conversation
			{  
				$idConversation = $row['id'];
				$query = "SELECT * FROM message_prive WHERE idConversation = $idConversation ORDER BY date DESC;";
				$res = $link->query($query);
				while($message = $res->fetch_assoc())	//Et chaque Message
				{
					if($message['lu']==0)
					{?>	<!-- Changer la classe de la div si le message n'est pas lu (genre txt en gras) -->
						<div id=<?php echo $message['id']; ?> class="nonLu" name="Message">
	<?php 			} else{?>
						<div id=<?php echo $message['id']; ?> class="Lu" name="Message">
	<?php			}?>	
						<span><?php echo $row['idEmetteur']; ?></span>
						<span><?php echo $message['titre']; ?></span>
						<span><?php echo $message['date']; ?></span>
						
					</div>
					
					<!--Div deroulé, affiche le message et l'editeur de texte pour repondre-->
					<div id="reponse<?php echo $row['id']; ?>">
						<span name="<?php echo $row['id']; ?>contenu" /><?php echo $message['contenu']; ?></span>
						<span><?php echo $row['date']; ?><span>
					</div>
<?php			} 
			} ?>
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
$(document).ready(function(){
	$("div[id^='reponse']").hide(); //Cache toutes les div dont le name commence 
});
	$("div[name='Message']").click(function(){
		var id = this.id;
		var emetteur = document.getElementsByName(id+'emetteur')[0].value;
		var contenu = document.getElementsByName(id+'contenu')[0].value;
		$('#reponse'+id).animate({
			height: 'toggle'
		});
		// $('#formAddCours').animate({
				// height: 'toggle'
			// });
		// alert("div[id='"+id+"reponse']");
		// $.ajax({
			// url: "../ajax/repondreMessage.php",
			// type: 'POST',
			// async: true,
			// data : {
				// login : login.value,
				// email : email.value
			// },
			// success : function(code_html){
				
			// },
	// });
		//alert()
		
	});
</script>
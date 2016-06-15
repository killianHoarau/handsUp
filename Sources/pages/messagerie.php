<?php
    $title="Messagerie";
    include("header.php");
	$login = $_SESSION['login'];
	$id = $_SESSION['id'];
	$query = "SELECT message.contenu, message.date, message.reponse, message.lu, u1.login as 'emetteur', u2.login as 'destinataire' FROM message, utilisateur u1, utilisateur u2 WHERE message.idEmetteur = u1.id AND message.idDestinataire = u2.id AND idEmetteur = $id OR idDestinataire = $id;";
	//echo $query;
	$result = $link->query($query);
?>
<section id="feature">
	<div class="container">
		<div class="center wow fadeInDown animated">
			<h2>Vos messages</h2>
<?php
			while($row=$result->fetch_assoc())
			{  if($row['lu']==0)
				{?>	<!-- Changer la classe de la div si le message n'est pas lu (genre txt en gras) -->
					<div id=<?php echo $row['id']; ?> class="nonLu" name="Message">
<?php 			} else{?>
					<div id=<?php echo $row['id']; ?> class="Lu" name="Message">
<?php			}?>	
					<span><?php echo $row['emetteur']; ?></span>
					<span><?php echo $row['contenu']; ?><span>
					<span><?php echo $row['date']; ?><span>
				</div>
<?php		} ?>
		</div>
	</div>
</section>

<?php
	include("footer.php");
	
?>
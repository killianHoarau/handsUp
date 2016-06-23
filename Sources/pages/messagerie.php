<?php
    $title="Messagerie";
    include("header.php");

	$login = $_SESSION['login'];
	$id = $_SESSION['id'];

	if($_SESSION['statut']==0) //Etudiant
		$query = "SELECT u.id, u.login FROM utilisateur u WHERE u.statut = 1;";
	else	//Enseignant
		$query = "SELECT u.id, u.login FROM utilisateur u";

	$resUsers = $link->query($query);
?>
<input id="idenCours" type='hidden' value="<?php echo $id; ?>" />
<section id="feature">
	<div class="container">
		<div class="center wow fadeInDown animated">
			<h2>Vos messages</h2>

			<!-- Nouveau message -->
			<i id="btnEdit" class="fa fa-pencil-square-o" aria-hidden="true"></i>
			<span class='popupW col-lg-12' id="RemplirChamps" style="display:none;"><?php echo utf8_encode("Veuillez remplir tous les champs"); ?></span>
			<div id="newMessage" enctype="multipart/form-data" class="wow fadeInDown msform animated animated" style="display: block; visibility: visible; animation-name: fadeInDown;">
				<select id="selectDestinataire" class="selectpicker" data-live-search="true" multiple title="Choisir destinataire(s)" data-width="100%">
<?php				 while($user = $resUsers->fetch_assoc())
					 {
						?><option value="<?php echo $user['id']; ?>"><?php echo $user['login']; ?></option>
<?php				} ?>
				</select>
				<input name="titre" id="newObject" placeholder="Objet"/>
				<textarea cols="80" class="ckeditor" id="editeur" name="editor1" rows="10"></textarea>
				<button id="envoyerMessage" class="next action-button" style="width: 100%;">Envoyer</button>
			</div>
			<!-- Affiche chaque conversation -->
			<div id="list-message">
			</div>

		</div>
	</div>

</section>

<?php
	include("footer.php");
?>
<script>
$(document).ready(function(){
	$('#newMessage').hide();
});
	var toggled = false;
	$("i[id='btnEdit']").click(function(){
		if(toggled){
			$('#newMessage').hide();
			toggled = false;
		}
		else{
			$('#newMessage').show();
			toggled = true;
		}
	});

	//Rempli la liste des conversations et des messages
	var id = document.getElementById('idenCours').value;
	$.ajax({
		url: "../ajax/getMessage.php",
		type: 'POST',
		async: true,
		data : {
			id : id
		},
		success : function(code_html){
			$('#list-message').html(code_html);
		},
});

//-----------------------------------Envoi du message------------------------------//
	$('#envoyerMessage').click(function(){
		var id = document.getElementById('idenCours').value;							//Recupère l'id de l'utilisateur connécté
		var titre = document.getElementsByName('titre')[0].value;						//Recupère l'objet du message
		var contenu = CKEDITOR.instances['editeur'].getData();							//Recupère le contenu du message
		var tabDestinataire = $('#selectDestinataire').val();							//Recupère la liste des idDestinataires
		$.ajax({
			url: "../ajax/ajoutMessage.php",
			type: 'POST',
			async: true,
			data : {
				id : id,
				titre : titre,
				contenu : contenu,
				tabDestinataire : tabDestinataire
			},
			success : function(code_html){
				if(code_html.substring(0,26)=="<br />"+ "\n"+"<b>Fatal error</b>:")
				{
					$('#RemplirChamps').animate({
						height: 'toggle'
					});
				}
				else
					$('#list-message').html(code_html);
			},
		});
	});
</script>

<?php
  $title="Inscription | Connexion";
	include("header.php");
?>

<br>
<div class="container">
	<div class="col-lg-12">
		<div class="col-lg-6">
			<div class="col-lg-12">
				<div class="titleprghp">
					<span class="prg">Inscription</span> 
				</div>
			</div>
			<div id="signIn" class="msform" method='POST'>
				<!-- fieldsets -->
				<fieldset>
					<input type="text" name="login" placeholder="Login"/>
					<input type="email" name="email" placeholder="Email"/>
					<input type="password" name="mdp" placeholder="Mot De Passe"/>
					<input type="password" name="cmdp" placeholder="Confirmation"/>
					<input type="text" name="code" placeholder="Code Etudiant / Enseignant"/>
					<input id='btnInscription' type="submit" name="next" class="next action-button" value="Inscription"/>
				</fieldset>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="col-lg-12">
				<div class="titleprghp">
					<span class="prg">Connexion</span> 
				</div>
			</div>
			<div class="formConnexion msform">
				<form action="../php/confirmLogin.php" method="POST" >
					<!-- fieldsets -->
					<fieldset>
						<input type="text" name="login" placeholder="Login" />
						<input type="password" name="mdp" placeholder="Mot De Passe" />
						<div class="col-lg-6"><input type="submit" name="next" class="next action-button" value="Connexion" /></div>
						<div class="col-lg-6"><button id="bstnOubli" class="next oubli-button">Un oubli?</button></div>
					</fieldset>
				</form>					
			</div>
		</div>	  
	</div> 
	<!-------------------------------------------------------------DEBUT DU POPUP ERREUR AVEC FORMULAIRE 
		<div class="formConnexion msform">
		<form action="../php/confirmOubli.php" method="POST" >
			<!-- fieldsets 
			<fieldset>
				<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="titleprghp">
					<h2 id="myModalLabel">Récupération</h2>
				</div>
				<h3>
					<br />Vous avez oublié votre mot de passe ou votre login?
					<br />Aucun souci, remplisser les informations que vous connaissez.
				</h3>
				<input type="text" name="login" placeholder="Login" />
				<input type="email" name="email" placeholder="Email"/>
				<div class="col-lg-6"><input type="submit" name="next" class="next action-button" value="Envoie" /></div>
			</fieldset>
		</form>
	</div>-->
</div>	 
	<?php
		include("popUp_ConfirmInscription.php");
		include("popUp_Oubli.php");
		include("popUp_Erreur.php");
	?>
</div>

<?php
	$nomScript="affiche_popUp_ConfirmationInscription";
	include("footer.php");
?>
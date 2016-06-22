<?php
  $title="Inscription | Connexion";
	include("header.php");
?>

<section id="feature" class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="titleprghp wow fadeInDown">
					<span class="prg">Connexion</span> 
				</div>
			</div>
			<div id="statutConnexion" class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
				<span id="connectVide" class='popupW col-xs-12 col-sm-12 col-md-12 col-lg-12'>Veuillez remplir les champs vident merci.</span>
			</div>
			
				<div id="Connect" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform">
					<!-- fieldsets -->
					<fieldset>
						<input type="text" name="loginC" placeholder="Login" />
						<input type="password" name="mdpC" placeholder="Mot De Passe" />
						<div class="col-lg-6"><input id="btnConnexion" type="submit" name="next" class="next action-button" value="Connexion" /></div>
						<div class="col-lg-6"><button id="btnOubli" class="next oubli-button">Un oubli?</button></div>
					</fieldset>
				</div>		
				
				<div id='formCompteOublie' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 msform wow fadeInDown formCompteOublie'>
					<fieldset>
						<input name='emailR' placeholder="Email"/>
						<div class="col-lg-6"><input id='btnRecuperation' type="submit" class="next action-button" value="Envoyer" /></div>
						<div class="col-lg-6"><button id='btnAnnul' class="next oubli-button">Annuler</button></div>
					</fieldset>
				</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="titleprghp wow fadeInDown">
					<span class="prg">Inscription</span> 
				</div>
			</div>
			<div id="statutInscription" class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
				<span id="erreurVide" class='popupW col-xs-12 col-sm-12 col-md-12 col-lg-12'>Veuillez remplir les champs vident merci.</span>
			</div>
			<div id="signIn" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform">
				<!-- fieldsets -->
				<fieldset>
					<input type="text" name="loginI" placeholder="Login"/>
					<input type="email" name="emailI" placeholder="Email"/>
					<input type="password" name="mdpI" placeholder="Mot De Passe"/>
					<input type="password" name="cmdpI" placeholder="Confirmation"/>
					<input type="text" name="codeI" placeholder="Code Etudiant / Enseignant"/>
					<input id='btnInscription' type="submit" name="next" class="next action-button" value="Inscription"/>
				</fieldset>
			</div>
		</div>
	</div>	  
</section> 

<?php
	$nomScript="affiche_popUp_ConfirmationInscription";
	include("footer.php");
?>
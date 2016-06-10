<?php
  $title="Inscription | Connexion";
	include("header.php");
?>

<section id="feature" class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="titleprghp wow fadeInDown">
					<span class="prg">Inscription</span> 
				</div>
			</div>
			<div id="statutInscription" class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
				<span id="erreurVide" class='popupW'>Veuillez remplir les champs en rouge</span>
			</div>
			<div id="signIn" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform">
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

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="titleprghp wow fadeInDown">
					<span class="prg">Connexion</span> 
				</div>
			</div>
			<div id="statutConnexion" class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
				<span id="connectVide" class='popupW'>Veuillez remplir les champs en rouge</span>
			</div>
			
				<div id="Connect" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform">
					<!-- fieldsets -->
					<fieldset>
						<input type="text" name="login" placeholder="Login" />
						<input type="password" name="mdp" placeholder="Mot De Passe" />
						<div class="col-lg-6"><input id="btnConnexion" type="submit" name="next" class="next action-button" value="Connexion" /></div>
						<div class="col-lg-6"><button id="btnOubli" class="next oubli-button">Un oubli?</button></div>
					</fieldset>
				</div>		
				
				<div id='formCompteOublie' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 msform formCompteOublie'>
					<fieldset>
								<span id="recupSpan" class='col-xs-12 col-sm-12 col-md-12 col-lg-12' style='position: relative; top: 0px;'>Remplissez les données dont vous vous souvenez</span>
								<input name='login' placeholder="Login"/>
								<input name='email' placeholder="email"/>
								<input id='btnRecuperation' type="submit" class="next action-button recupererBnt" value="Envoyer" />
					</fieldset>
				</div>
		</div>
	</div>	  
</section> 

<?php
	$nomScript="affiche_popUp_ConfirmationInscription";
	include("footer.php");
?>
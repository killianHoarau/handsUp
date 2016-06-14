<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header('Location: index.php');
	}
    $title="Compte ". $_SESSION['login'];
    include("header.php");
	include("../php/infoCompte.php");
?>
    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Voici vos informations
					<button id="btnEdit">
						<i class="fa fa-pencil-square-o fa-lg"/></i>
					</button>
				</h2>
                <p class="lead">Ici vous pouvez mettre à jour vos information personnel</p>

            </div>

            <div class="row">
                <div class="features">
                     <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="info-perso">
                            <h3>Nom d'utilisateur</h3>
                            <p id="login"><?php echo $_SESSION['login']; ?></p>
							<input id="inputLogin" type="text"  value="<?php echo $_SESSION['login']?>" />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="info-perso">
                            <h3>Votre Email</h3>
                            <p id="email"><?php echo $_SESSION["email"]; ?></p>
							<input id="inputEmail" type="text"  value="<?php echo $_SESSION['email']?>" />
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="info-perso">
                            <h3>Votre statut</h3>
                            <p><?php
								if ($_SESSION["droit"] == 0) {
                            		echo "Etudiant";
                            	}else {
                            		echo "Enseignant";
                            	} ?>
							</p>
                        </div>
                    </div>
                </div>
            </div>

			<div class=" row msform">
				<div class="col-lg-6">
					<button id='btnSaveInfo' name="next" class="next action-button">Valider</button>
				</div>
				<div class="col-lg-6">
					<button id="btnCancelInfo" class="next oubli-button">Annuler</button>
				</div>

			</div>
        </div>
    </section><!--/#feature-->

    <section id="feature" >
        <div class="container">
           <div id='listCours' class="center wow fadeInDown"> 
				<!--Remplit par ajax/getCours.php -->
            </div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform animated">
				<button class="next action-button col-md-12" style='width: 100%;'>Ajouter Cours</button>
			</div>
			
			<!-- Formulaire de creation de cours et d'upload d'un fichier-->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform animated">
				<input name="libelle" placeholder="Titre du cours" />
				<textarea name="description" placeholder="Description du cours"></textarea>
				<!--Personnalisation de l'input file en rusant un peu-->
				<input type="file" id="hiddenfile" style="display:none;" name="file" onChange="getvalue();"/>
				<input type="text" id="selectedfile" placeholder="Fichier Selectionné (Facultatif)" disabled="disabled"/>
				<input type="button" value="Joindre Fichier" class='btn-default' onclick="getfile();" />
				<button id="btn-upload" class='btn btn-default'>Envoyer</button>
			</div>
            <div class="row">
                <div class="features">

                </div>
            </div>
        </div>
    </section><!--/#feature-->

	<!-- <section id="feature" class="">
		<fieldset class="msform">
			<input type="text" name="login" placeholder="Login"/>
			<input type="email" name="email" placeholder="Email"/>
			<input type="password" name="mdp" placeholder="Mot De Passe"/>
			<input type="password" name="cmdp" placeholder="Confirmation"/>
			<input type="text" name="code" placeholder="Code Etudiant / Enseignant"/>
			<input id='btnInscription' type="submit" name="next" class="next action-button" value="Inscription"/>
		</fieldset>
	</section> -->

<?php
	$nomScript="modifCompte";
    include("footer.php");
?>

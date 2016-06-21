<?php
	$title="Compte ". $_SESSION['login'];    
	include("header.php");
	if (!isset($_SESSION['login']) || $_SESSION['droit'] == 2){
		header('Location: index.php');
	}
	include("../php/infoCompte.php");
?>
<!-- Modal -->
<div class="modal fade"  id="myModal" role="dialog">
	<div class="modal-dialog modal-sm">
	  <div class="modal-content">
	    <div class="modal-header">
	    	<input type="text" id="valId" value=""/>
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Attention!</h4>
	    </div>
	    <div class="modal-body">
	      <p>Voulez-vous vraiment supprimer ce cours?</p>
	    </div>
	    <div class="modal-footer msform">
		  <a data-dismiss="modal" class="next oubli-button">Annuler</a>
		  <a data-dismiss="modal" class="next action-button" name="supprimerCours">Confimer</a>
	    </div>
	  </div>
	</div>
</div>
    <section id="feature">
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Voici vos informations
					<button id="btnEdit">
						<i class="fa fa-pencil-square-o fa-lg"/></i>
					</button>
				</h2>
                <p class="lead">Ici vous pouvez mettre à jour vos informations personnelles</p>
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
                            <p>
<?php
								if ($_SESSION["droit"] == 0) {
                            		echo "Etudiant";
                            	}else {
                            		echo "Enseignant";
                            	}
?>
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
			<div id="popup" class="dc-box" style="display: none;">
				<i id="closepopup" class="fa fa-times col-xs-12 col-sm-12 col-md-12 col-lg-12" aria-hidden="true"></i>
			</div>
           <div id='listCours' class="center wow fadeInDown">
				<!--Remplit par ajax/getCours.php -->
            </div>
			<?php if($_SESSION['droit']==1)
{ ?>
			<!-- Formulaire de creation de cours et d'upload d'un fichier-->
			<form action="../ajax/ajoutCours.php" method="POST" id="formAddCours" hidden enctype="multipart/form-data" class="wow fadeInDown msform animated">
				<input name="libelle" placeholder="Titre du cours" />
				<textarea cols="80" class="ckeditor" id="editeur" name="addDescription" rows="10"></textarea>
				<!--<textarea name="addDescription" placeholder="Description du cours"></textarea>
				Personnalisation de l'input file en rusant un peu-->
				<input type="file" id="hiddenfile" style="display:none;" name="file" onChange="getvalue();"/>
				<input type="text" id="selectedfile" placeholder="Fichier Selectionné (Facultatif : Un fichier peut être uploader une fois le cours créée)" disabled="disabled"/>
				<button id="btnAddCours" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 next action-button" style='width: 100%;'>Ajouter Cours</button>
				<input type="button" value="Joindre Fichier" class='btn-default' onclick="getfile();" />
			</form>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform animated">
				<button id="annul" class='next action-button'>Créer Un Cours</button>
			</div>
<?php } ?>


        </div>
    </section><!--/#feature-->


	<!-- pop up modif cours -->

	<!-- <section id="feature">
		<div class="container">
			<div class="center wow fadeInDown">
				 <h2>Modifier le cours</h2>
			 </div>
			 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform animated">
				<input name="libelle" value=""/>
				<textarea name="description" value=""></textarea>
				<input type="file" id="hiddenfile" style="display:none;" name="file" onChange="getvalue();"/>
				<input type="text" id="selectedfile" placeholder="Fichier Selectionné (Facultatif)" disabled="disabled"/>
				<input type="button" value="Joindre Fichier" class='btn-default' onclick="getfile();" />
				<button id="btn-upload" class='btn btn-default'>Envoyer</button>
			</div>
		</div>
	</section> -->



<?php
	$nomScript="modifCompte";
    include("footer.php");
?>

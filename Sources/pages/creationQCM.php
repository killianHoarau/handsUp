<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header('Location: index.php');
	}
	$idCours = $_GET["idCours"];
    $title="Création QCM";
    include("header.php");
	include("../php/infoCompte.php");
?>

<input type="hidden" name="idCours" value="<?php echo $idCours ?>">
<section id="feature" >
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2>Créer un QCM pour le cours : <?php echo $libelle; ?> </h2>
			<p class="lead">Ici vous pouvez créer un QCM et lui ajouter des réponses</p>
		</div>


		<div class="row">
			<div class="features">
				 <div class="col-md-12 col-sm-12 wow fadeInDown add-question" data-wow-duration="1000ms" data-wow-delay="600ms">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<p>Libelle de la question</p>
					</div>
					<div class="col-md-5 msform">
						<input name="libelleQuestion" type="text" value="" size="30"/>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="features">
				<div class="col-md-12 col-sm-12 wow fadeInDown add-question" data-wow-duration="1000ms" data-wow-delay="600ms">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<!-- Liste des reponses ajouté rempli par JS -->
						<ul id="listeReponses" name="listeReponses">
						</ul>
					</div>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
				<div class="col-md-2"></div>
				<div class="col-md-3">
					<span id="btnMoreReponse">
						<i class="fa fa-plus-circle fa-lg"/></i> Ajouter une réponse
					</span>
					<span id="btnLessReponse">
						<i class="fa fa-minus-circle  fa-lg"/></i> Annuler
					</span>
				</div>
				<div class="col-md-7 ">
				</div>
			</div>
		</div>

		<div class=" row msform">
			<div class="col-md-12 col-sm-12 add-reponse" data-wow-duration="1000ms" data-wow-delay="600ms">
				<div class="col-md-2"></div>
				<div class="col-lg-4">
					<input type="text" name="libelleReponse" value="" placeholder="Libelle">
				</div>
				<div class="col-lg-2 checkbox">
					<label><input type="checkbox" name="bonneReponse" value=""> Bonne réponse</label>
				</div>
				<div class="col-md-2" style="text-align: right;">
					<span id='btnAddReponse' class="next action-button">Valider</span>
				</div>
			</div>
		</div>

		<div class=" row msform">
			<div class="col-md-12 col-sm-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="row">
						<!-- Valider le QCM -> ajax -->
						<button id='btnValiderQuestion' type="submit" class="next action-button">Valider le QCM</button>
					</div>
					<div class="row">
						<!-- retour à la page compte -->
						<button id='btnAnnulerQCM' class="next oubli-button">Annuler le QCM</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!--/#feature-->

<?php
	$nomScript="creationQCM";
    include("footer.php");
?>

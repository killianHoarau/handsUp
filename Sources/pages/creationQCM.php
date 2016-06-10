<?php
	session_start();
	// if (!isset($_SESSION['login'])){
	// 	header('Location: index.php');
	// }
    $title="Création QCM";
    include("header.php");
	include("../php/infoCompte.php");
?>

<section id="feature" >
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2>Créer un QCM pour le cours <?php echo "xxx"; ?> </h2>
			<p class="lead">Ici vous pouvez créer un QCM et lui ajouter des réponses</p>

		</div>

		<form class="" action="../php/ajoutQCM.php" method="post">

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
						<button id='btnValiderQuestion' type="submit" class="next action-button">Valider le QCM</button>
					</div>
				</div>
			</div>
		</form>

	</div>
</section><!--/#feature-->

<?php
	$nomScript="";
    include("footer.php");
?>

<?php
	$title = "Scann";
	include("header.php");
?>

<section id="feature" class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container pageCours">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center wow fadeInDown">
			<h2>Acceder à un cours</h2>
			<p>Entrez le code d'un cours pour y acceder</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 wow fadeInDown msform">
			<div class="col-xs-2 col-sm-2 col-md-4 col-lg-4"></div>
			<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4">
				<input type="text" id="idCours" placeholder="Code">
			</div>
			<div class="col-xs-2 col-sm-2 col-md-4 col-lg-4"></div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<button id='btnGoCours' class="next action-button">Valider</button>
			</div>
		</div>
	</div>
</section>

<?php
    include("footer.php");
?>

<script type="text/javascript">

	$('#btnGoCours').click(function() {
		var idCours = $('#idCours').val();
		location.href = 'http://localhost/handsup/Sources/pages/cours.php?idCours='+idCours;
	});
</script>

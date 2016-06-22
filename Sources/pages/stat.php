<?php
	$title = "Statistiques";
	include("header.php");

	if (!isset($_SESSION['login']) || $_SESSION['droit'] == 2 || $_SESSION['droit'] == 0){
		header('Location: index.php');
	}

	include("../php/infoStat.php");
?>

<section id="feature">
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2>Statistiques du cours <?php echo utf8_encode($cour['libelle']); ?></h2>
		</div>
		<?php foreach ($questions as $question): ?>
			<div class="row center">
				<p>QCM<?php echo $question['num']; ?>: <?php echo $question['libelle']; ?></p>
				<input type="hidden" name="befor10<?php echo $question['id']; ?>" value="<?php echo $question['befor10']; ?>">
				<input type="hidden" name="befor30<?php echo $question['id']; ?>" value="<?php echo $question['befor30']; ?>">
				<input type="hidden" name="after30<?php echo $question['id']; ?>" value="<?php echo $question['after30']; ?>">
				<div class="col-md-6">
					<div id="<?php echo $question['id']; ?>" name="grapheTemps"></div>
				</div>
				<div class="col-md-6">
					<div id="rep<?php echo $question['num']; ?>" name="grapheReponse"></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<?php $n = json_encode($questions);?>

<script type="text/javascript">
<?php echo "var tab = $n" ?>
</script>

<?php
	$nomScript="stat";
    include("footer.php");
?>

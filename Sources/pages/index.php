<?php
    $title="Accueil";
	$home = true;
    include("header.php");
	if(isset($_GET['email']))
	{
		$email = $_GET['email'];
		$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
		$query = "UPDATE utilisateur set valide = 1
			WHERE email = '$email'";
		//echo $query;
		$result = $link->query($query);
	}
?>
<div id="firstConnection" class="row" style="display: block;">
		<span id="bienvenu" class="popup col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: block;">Bienvenue, bon cours !</span>
</div>

<section id="main-video" class="row">
	<div class="col-md-2 col-lg-2"></div>
    <video controls class="col-xs-12 col-sm-12 col-md-8 col-lg-8" src="../images/index/pub.mp4">Publicité de l'application</video>
    <div class="col-md-2 col-lg-2"></div>
</section>

<section id="feature" class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container center wow fadeInDown">
        <h2>Pour vous les profs</h2>
        <p class="lead">Grâce à nous fini le papier, les cours rébarbatifs et sans energie!!!</p>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row features">
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
			<div class="feature-wrap">
				<i class="fa fa-video-camera"></i>
				<h2>Visualisation</h2>
				<h3>Diffuser vos cours directement depuis Hands Up!</h3>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
			<div class="feature-wrap">
				<i class="fa fa-download"></i>
				<h2>Récupération</h2>
				<h3>Fini la file d'attente devant la photocopieuse, le cours est téléchargeable au format PDF</h3>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
			<div class="feature-wrap">
				<i class="fa  fa-question "></i>
				<h2>Intéraction</h2>
				<h3>Une baisse d'energie? Faites participer vos élèves en leur donnant des QCM</h3>
			</div>
		</div>
	</div>
</section>

<section id="services" class="row service-item">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container center wow fadeInDown">
		<h2>Mais aussi pour vous étudiants</h2>
		<p class="lead">Finis les cours des années 50 à la craie, plus de cahier A4 96 pages ... <br>Place au cours 2.0</p>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="media services-wrap wow fadeInDown">
				<div>
					<img class="img-responsive icoImg" src="../images/ico/qrcode.png">
				</div>
				<div class="media-body">
					<h3 class="media-heading">QR Code</h3>
					<p>Pour avoir votre cours flasher son QR Code</p>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="media services-wrap wow fadeInDown">
				<div>
					<img class="img-responsive icoImg" src="../images/ico/chat.png">
				</div>
				<div>
					<h3 class="media-heading">Pour vous timides</h3>
					<p>Peur de prendre la parole en public? Utilisez le Chat!</p>
				</div>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="media services-wrap wow fadeInDown">
				<div>
					<img class="img-responsive icoImg" src="../images/ico/livre.png">
				</div>
				<div class="media-body">
					<h3 class="media-heading">Fini le papier</h3>
					<p>Maintenant tous vos cours sont sur Hands Up</p>
				</div>
			</div>
		</div>
	</div><!--/.row-->
	</section>

	<section id="feature" class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container center wow fadeInDown">
        <h2>Télécharger un lecteur de QR code</h2>
        <p class="lead">Accéder directement à un cours via le QR code fourni par l'enseignant</p>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row features">
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
			<div class="feature-wrap">
                            <a href="https://play.google.com/store/apps/details?id=com.application_4u.qrcode.barcode" class="fa fa-android" target="_blank"></a>
                            <h2 id="market">Android</h2>
                        </div>
		</div>

		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
			<div class="feature-wrap">
                            <a href="https://itunes.apple.com/fr/app/scanner-de-codes-qr/id483336864?mt=8" class="fa fa-apple" target="_blank"></a>
                            <h2 id="market">Apple</h2>
                        </div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
			<div class="feature-wrap">
                            <a href="https://www.microsoft.com/fr-fr/store/apps/code-qr-code-barre/9nblggh3m5fl" class="fa fa-windows" target="_blank"></a>
                            <h2 id="market">Windows</h2>
                        </div>
		</div>
	</div>
    </section><!--/#feature-->

<?php
    include("footer.php");
?>
<script>
	$(document).ready(function(){
		$('#firstConnection').hide();
		var isset = <?php echo isset($_GET['email']); ?>+' ';
		if (isset == 1){
			$('#firstConnection').animate({
								height: 'toggle'
							});
			setTimeout(function(){
				$('#firstConnection').animate({
								height: 'toggle'
				});
				}, 2000);
		}
		//else
			//alert("no");
	});
</script>

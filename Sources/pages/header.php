	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>

	<!-- core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/panel.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/prettyPhoto.css" rel="stylesheet">
    <link href="../css/messagerie.css" rel="stylesheet">
    <link href="../css/formulaires.css" rel="stylesheet">
    <link href="../css/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
    <link href="../bootstrap-select-master/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="../images/ico/onglet.ico">
</head><!--/head-->

<body class="homepage">
<div id="wrapper" class="row">
<div id="header">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img src="../images/logo/headerBlanc.png" id="logoFull" alt="logo"></a>
            <a class="navbar-brand" href="index.php"><img src="../images/logo/HeaderMobileBlanc.png" id="logoMobile" alt="logo"></a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                   <li class="active"><a href="index.php">Accueil</a></li>
					<li><a href="../pages/scan.php">Scanner</a></li>
<?php
                        session_start();
                        if (!isset($_SESSION['login']))
                        {
?>
							<li><a href="inscriptionConnexion.php">Connexion/Inscription</a></li>
<?php
                        }
                        else
                        {
							$id = $_SESSION['id'];
?>							<input type="hidden" value="<? echo $id; ?>" id="monId"> <?php
							if ($_SESSION['droit'] == 2) {
?>
								<li><a href="admin.php">Administration</a></li>
<?php
							}else {
?>
								<li><a href="compte.php"><?php echo $_SESSION['login']?></a></li>
<?php
							}
?>
                            <li><a id="lienMessagerie" href="../pages/messagerie.php">Messagerie</a></li>
                            <li><a href="../php/deconnexion.php">Deconnexion</a></li>
<?php
                        }
?>

                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</div><!--/header-->
<div id="content">

<!-- Connexion BDD -->
<?php
	session_start();
	$link = new mysqli('localhost', 'root', 'mysql', 'handsup');
?>

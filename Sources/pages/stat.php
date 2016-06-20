<?php
	session_start();
	if (!isset($_SESSION['login']) || $_SESSION['droit'] == 1){
		header('Location: index.php');
	}
    $title="Statistiques";
	// include("../php/infoStat.php");
?>


<?php
	$nomScript="stat";
    include("footer.php");
?>

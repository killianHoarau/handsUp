<?php
	session_start();
	// if (!isset($_SESSION['login'] == 2)){
	// 	header('Location: index.php');
	// }
    include("header.php");
	include("../php/infoAdmin.php");
?>

<section id="feature" >
	<div class="container">
	   <div class="center wow fadeInDown">
			<h2>Supprimer des utilisateurs</h2>
		</div>
		<ul>
			<?php for ($i=0; $i < count($utilisateurs); $i++) { ?>
				<li>
					<?php echo $utilisateurs[$i]["login"]; ?>
					<i class="fa fa-trash-o fa-lg poubelle"  id="delete<?php echo $utilisateurs[$i]['id']; ?>" name="<?php echo $utilisateurs[$i]["id"]; ?>"></i>
				</li>
			<?php } ?>
		</ul>
	</div>
</section>


<?php
	$nomScript="admin";
    include("footer.php");
?>

</div>
<div id="footer" class="midnight-blue footer row">
        <div class="container">
                    <a class="navbar-brand" href="index.php"><img src="../images/logo/footer.png" class="logoFooter" alt="logo"></a>
        </div>
    </div><!--/#footer-->
</div><!-- Wrapper -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.prettyPhoto.js"></script>
    <script src="../js/jquery.isotope.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/prefixfree.min.js"></script>
    <!--<script src="../js/panel.js"></script>-->
    <script src="../js/ckeditor/ckeditor.js"></script>
    <script src="../bootstrap-select-master/bootstrap-select.min.js"></script>
	<script src='http://api.ning.com:80/files/c2nk1pk6akRu1GY7OtAu5q0yM-jDtKnppTnmc5x4a-1uPsV3XwUxzc3x5n0sOrDigAplocO-JoWzExI0CNdKYwt1q-JRowJW/qrcode.min.js'></script>

	<!-- Highcharts -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>

	<?php 
	if(isset($nomScript))
	{
		if(file_exists("../js/$nomScript.js"))
		{ ?>
			<script src="../js/<?php echo $nomScript ?>.js"></script>
	<?php }
	}?>
	<script>
		if($("#monId").length > 0) //Si le mec est logé
		{
			var id = document.getElementById('monId').value;
			var lienMessage = document.getElementById('lienMessagerie');
			function getnbMessage()
			{
				$.ajax({
					url: "../ajax/getNombreMessage.php",
					type: 'POST',
					async: true,
					data : {
						id : id
						},
					success: function(code_html)
					{
						var nombreMessage = $.parseJSON(code_html);
						if ($("#spanNbMessages").length > 0)
						{
							var span = document.getElementById("spanNbMessages")
							span.innerHTML = '<sup> ' + nombreMessage + '<sup>';
						}
						else
						{
							var span = document.createElement("SPAN");
							span.setAttribute("id", "spanNbMessages");
							span.style.fontSize = "1.2em";
							span.innerHTML = '<sup> ' + nombreMessage + '<sup>';
							lienMessage.appendChild(span);
							// Cree une div avec le nombre de message
						}
					}
				});
			}
			getnbMessage();
			setInterval(getnbMessage, 10000); //Rafraichi toutes les 10 secondes REPONSE 42 !
		}
	</script>
    </body>
</html>

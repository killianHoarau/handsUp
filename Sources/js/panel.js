	$(document).ready(function(){
		$("div[name^='trInfos']").hide(); //Cache toutes les div dont le name commence par 'trInfos'
		$("div[name='trCours']").click(function(){	
			var id = this.id;
			if ($('div[name="trInfos'+id+'"]').is(":visible")){
				$('div[name="trInfos'+id+'"]').slideUp(1000);
			}else{
				$('div[name="trInfos'+id+'"]').slideDown(1000);
			}
			
		});
	});
	//Suppression au click sur la poubelle
	$( "i" ).click(function(){
		var ide = this.id;
		//alert(id);
		//On rappelle getCours pour faire la modif et afficher la liste des cours Mise a jour (sans rechargement)
		$.ajax({
			url: "../ajax/getCours.php",
			type: 'POST',
			async: true,
			data : {
				suppr : ide
				},
			success: function(code_html)
			{
				$('#listCours').html(code_html);
			}
		});
	});

	$('#btFermer').click(function(event){
			alert("ok");
			var idUp = this.id;
			alert(idUp);
			$('div[name="trInfos'+idUp+'"]').slideUp(1000);
		});		

	$("i[id^='qcm']").click(function() {
		document.location.href = "creationQCM.php?idCours="+this.attributes["name"].value;
	});
$(document).ready(function(){
	//$("input[id^='Ajoutselectedfile']").hide();
	//$("input[id^='submitAddPJ']").hide();
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
$( "[name='supprimerCours']" ).click(function(){
	var ide = document.getElementById("valId").value;
	//alert(ide);
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

$( "i[name^='confSupr']" ).click(function(){
	var ide = this.id;
	valID= ide.split("confSupr");
	document.getElementById("valId").value= valID[1];
});

//Telechargement du fichier joint a chaque cours lors du clique sur le <i> download
$("i[name^='dl']").click(function(){
	$(this).closest("form").submit();
	return false;
});

//Upload du fichier pour un cours qui n'en a pas deja
$("i[name^='ul']").click(function(){
	var name = this.getAttribute("name");
	var idPasse = name.substring(2);
	$("input[id='Ajoutselectedfile" + idPasse +"']").show();
	$("input[id^='submitAddPJ']").show();
	document.getElementById('Ajouthiddenfile'+idPasse+'').click();
});

//Affiche le fichier selectionne
$("input[id^=Ajouthiddenfile]").change(function(){
	var id = this.id;
	var idCours = id.substring(15);
	$("#Ajoutselectedfile" + idCours).val(this.value);
});

$("img[id^='qcm']").click(function() {
	document.location.href = "creationQCM.php?idCours="+this.attributes["name"].value;
});

$('button[name="btnFermer"]').click(function(){
	var name = this.parentNode.parentNode.getAttribute("name");
	name = name.substring(7);
	$('div[name="trInfos'+name+'"]').slideUp(name);
});

//Créé le QR code pour chaque cours
var tabQR = document.getElementsByName('linkQR');
for(var i=0; i<tabQR.length; i++)
{
	var id = tabQR[i].id.substring(4);
	//console.log(id);
	var qr = new QRCode("qrcode"+id);
	qr.makeCode($('#text'+id).val());	//Créé le QR avec la valeur de l'input text qui est caché
	$('#qrcode' + id).find("img").css({"width": "40px"});	//Permet d'afficher le QR en petit

	//Affiche la popup du QRCode en gros pour pouvoir le scanner
	$('#qrcode' + id).find("img").click(function(){
		$('#PopUpQRcode').children('img').remove();
		$('#PopUpQRcode').children('h4').remove();
		// alert(this.nodeName);
		var idclicked = this.parentNode.id.substring(6);
		//alert(idclicked);
		var imgClone = this.cloneNode(true);
		//imgClone.style.width = "50%";
		$('#PopUpQRcode').append("<h4>Code d'accés au cours: "+idclicked+"</h4>");
		$('#PopUpQRcode').append(imgClone);
		//$('#PopUpQRcode').show();
	});
}

$('#closepopup').click(function(){
	$('#popup').children('img').remove();
	$('#popup').hide();
});

//Redirection vers la page de stat global
$("i[id^='stat']").click(function(){
	document.location.href = "stat.php?idCours="+this.attributes["name"].value;
});

//Redirection vers la page du cours
	$("i[id^='goCours']").click(function(){
		document.location.href = "cours.php?idCours="+this.attributes["name"].value;
	});

//Affiche le popup modif cours
$("i[id^='modif']").click(function(){
	trCours = document.getElementsByName('trCours');
	for (var i = 0; i < trCours.length; i++) {
		if (trCours[i].title == 'monLibelle' && trCours[i].id == this.attributes['name'].value) {
			document.getElementById('modifLibelle').value = trCours[i].attributes['value'].value;
		}
	}
	document.getElementById('idCoursModif').value = this.attributes['name'].value;

	CKEDITOR.instances['editeur2'].setData(document.getElementById("desc"+this.attributes['name'].value).textContent);
});

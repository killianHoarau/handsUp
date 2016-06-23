$( document ).ready(function() {

	if (suivre) {
		$(".cours-suivi").show();
    }else {
		$("#btnSuivreCour").show();
    }

	var theToggle = document.getElementById('toggle');

	// based on Todd Motto functions
	// http://toddmotto.com/labs/reusable-js/

	// hasClass
	function hasClass(elem, className) {
		return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
	}
	// addClass
	function addClass(elem, className) {
	    if (!hasClass(elem, className)) {
	    	elem.className += ' ' + className;
	    }
	}
	// removeClass
	function removeClass(elem, className) {
		var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
		if (hasClass(elem, className)) {
	        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
	            newClass = newClass.replace(' ' + className + ' ', ' ');
	        }
	        elem.className = newClass.replace(/^\s+|\s+$/g, '');
	    }
	}
	// toggleClass
	function toggleClass(elem, className) {
		var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
	    if (hasClass(elem, className)) {
	        while (newClass.indexOf(" " + className + " ") >= 0 ) {
	            newClass = newClass.replace( " " + className + " " , " " );
	        }
	        elem.className = newClass.replace(/^\s+|\s+$/g, '');
	    } else {
	        elem.className += ' ' + className;
	    }
	}

	theToggle.onclick = function() {
	   toggleClass(this, 'on');
	   return false;
	}
});

$('#btnSuivreCour').click(function() {
	var suivreCours = true;

	if (!droit) {
		document.location = 'inscriptionConnexion.php';
	} else if (droit == 1 || droit == 2) {
		alert('Vous devez être connectez en temps qu\'étudiant');
	}else {
		$.ajax({
			url: "../ajax/confirmSuivreCours.php",
			type: 'POST',
			async: true,
			data : {
				idCours : idCours,
				idUtilisateur : idUtilisateur,
				suivreCours : suivreCours
			},
			success : function(){
				$("#btnSuivreCour").hide();
				$(".cours-suivi").show();
			},
		});
	}
});

$("i[id^='btnVerouiller']").click(function() {
	var idQuestion = this.attributes["name"].value;
	var verrouille = document.getElementsByName('verrouille'+idQuestion)[0].value;
	var verrouillerQuestion = true;

	if (verrouille == 1) {
		verrouille = 0;
	}else {
		verrouille = 1;
	}
	$.ajax({
		url: "../ajax/confirmSuivreCours.php",
		type: 'POST',
		async: true,
		data : {
			idCours : idCours,
			idQuestion : idQuestion,
			verrouille : verrouille,
			verrouillerQuestion : verrouillerQuestion
		},
		success : function(code_html){
			$('#listQCM').html(code_html);
		},
	});

});

$("a[id^='btnRepondre']").click(function() {
	var ordre = document.getElementById("ordre0").value;
	var idQuestion = this.attributes["name"].value;
	document.location = "reponseQCM.php?idQuestion="+idQuestion+"&ordre="+ordre;

});

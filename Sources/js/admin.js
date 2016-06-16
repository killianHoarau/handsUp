$(document).ready(function(){

	$("i[id^='deleteUser']").click(function() {
		var idUtilisateur = this.attributes["name"].value;

		$.ajax({
			url: "../ajax/confirmAdmin.php",
			type: 'POST',
			async: true,
			data : {
				idUtilisateur : idUtilisateur
			},
			success : function(code_html){
				$('#listUtilisateur').html(code_html);
			},
		});
	});

	$("i[id^='deleteCode']").click(function() {
		var code = this.attributes["name"].value;

		$.ajax({
			url: "../ajax/confirmAdmin.php",
			type: 'POST',
			async: true,
			data : {
				code : code
			},
			success : function(code_html){
				$('#listCodeAcces').html(code_html);
			},
		});
	});

	$('#btnShowAddCode').click(function() {
		$(".add-code").css('display', 'block');
		$('#btnShowAddCode').hide();
		$("#btnHideAddCode").css('display', 'block');
	});
	$('#btnHideAddCode').on('click', function(){
		$(".add-code").hide();
		$('#btnHideAddCode').hide();
		$("#btnShowAddCode").css('display', 'block');
	});

	$("#btnAddCode").click(function() {
		var codeAjout = document.getElementsByName('code')[0].value;
		var statuts = document.getElementsByName('statut');
		for (var i = 0; i < statuts.length; i++) {
			if (statuts[i].checked) {
				var statut = statuts[i].value;
			}
		}

		$.ajax({
			url: "../ajax/confirmAdmin.php",
			type: 'POST',
			async: true,
			data : {
				codeAjout : codeAjout,
				statut : statut,
				ajout :  true
			},
			success : function(code_html){
				$(".add-code").hide();
				$('#btnHideAddCode').hide();
				$("#btnShowAddCode").css('display', 'block');

				$('#listCodeAcces').html(code_html);
			},
		});
	});

});

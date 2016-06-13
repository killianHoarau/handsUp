jQuery(function($) {'use strict',

	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});


// Page compte
	var toggled = false;
	$('#btnEdit').on('click', function(){
		if (!toggled) {
			$("#inputLogin").css('display', 'block');
			$("#inputEmail").css('display', 'block');
			$("#btnSaveInfo").css('display', 'block');
			$("#btnCancelInfo").css('display', 'block');

			$('#login').hide();
			$('#email').hide();

			toggled = true;
		}else {
			$("#inputLogin").hide();
			$("#inputEmail").hide();
			$("#btnSaveInfo").hide();
			$("#btnCancelInfo").hide();

			$('#login').css('display', 'block');
			$('#email').css('display', 'block');

			toggled = false;
		}
	});

	$('#btnCancelInfo').on('click', function(){
		$("#inputLogin").hide();
		$("#inputEmail").hide();
		$("#btnSaveInfo").hide();
		$("#btnCancelInfo").hide();

		$('#login').css('display', 'block');
		$('#email').css('display', 'block');
	});


	// Page Creation QCM
		$('#btnMoreReponse').on('click', function(){
			$(".add-reponse").css('display', 'block');
			$('#btnMoreReponse').hide();
			$("#btnLessReponse").css('display', 'block');
		});

		$('#btnLessReponse').on('click', function(){
			$(".add-reponse").hide();
			$('#btnLessReponse').hide();
			$("#btnMoreReponse").css('display', 'block');
		});


		var index = 0;
		var tabReponses = new Array();
		$('#btnAddReponse').on('click', function(){

			var libelleReponse = document.getElementsByName('libelleReponse')[0].value;
			var bonneReponse = document.getElementsByName('bonneReponse')[0].checked;
			tabReponses[index] = new Array(libelleReponse, bonneReponse);

			var li = document.createElement("li");

			var textReponse = document.createTextNode(libelleReponse);
			li.appendChild(textReponse);
			var input = document.createElement("input");
			input.setAttribute("value", libelleReponse);
			input.setAttribute("name", "reponse"+index);
			input.setAttribute("type", "hidden");
			li.appendChild(input);


			//Création du bool de bonne réponse hidden
			var bool = document.createElement("input");
			bool.setAttribute("value", bonneReponse);
			bool.setAttribute("name", "bool"+index);
			bool.setAttribute("type", "hidden");
			li.appendChild(bool);

			//Ajout de la classe pour la puce
			if (document.getElementsByName('bonneReponse')[0].checked) {
				li.className += "bonneReponse";
			}else {
				li.className += "mauvaiseReponse";
			}

			//Création du bouton boubelle
			var btn = document.createElement("span");
			btn.id = "btnDeleteReponse";
			var i = document.createElement("i");
			i.className += "fa fa-trash-o fa-lg";
			btn.appendChild(i);
			li.appendChild(btn);

			document.getElementById("listeReponses").appendChild(li);

			$(".add-reponse").hide();
			$('#btnLessReponse').hide();
			$("#btnMoreReponse").css('display', 'block');

			index++;

		});


		$('#btnValiderQuestion').on('click', function(){

			var question = document.getElementsByName('libelleQuestion')[0].value;

			$.ajax({
				url: "../ajax/confirmAjoutQCM.php",
				type: 'POST',
				async: true,
				data : {
					question : question,
					tabReponses : tabReponses
				},
				success : function(code_html){
					console.log(code_html);
				},
			});
		});
	//

	//Initiat WOW JS
	new WOW().init();
});

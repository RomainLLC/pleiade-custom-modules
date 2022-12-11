

(function ($, Drupal, drupalSettings) {
	Drupal.behaviors.APIlemonDataPleiadeBehavior = {
	  attach: function (context, settings) {
		// var field_lemon_url = drupalSettings.api_lemon_pleiade.field_lemon_url;
		// var field_lemon_myapplications_url = drupalSettings.api_lemon_pleiade.field_lemon_myapplications_url;
		// var field_pastell_url = drupalSettings.api_lemon_pleiade.field_pastell_url;
		// var field_parapheur_url = drupalSettings.api_lemon_pleiade.field_parapheur_url;
		// var field_ged_url = drupalSettings.api_lemon_pleiade.field_ged_url;
		
		$(document).ready(function() {

			// TEST JS custom module init
			console.log('Module Pléiade API/Lemon --> hello :))');


			$.ajax({
				url : Drupal.url('api_lemon_pleiade/pleiade-data-autocomplete'), // on appelle le script JSON
				dataType : 'json', // on spécifie bien que le type de données est en JSON
				type: "POST",
				data : {
					//variable envoyé avec la requête vers le serveur
					myapplications : '' // pour le moment on recupere tout ce que renvoie myapplications de lemon
				},
				success : function(donnees){
					//donnees est le reçu du serveur avec les résultats
					console.log(donnees);

					// on l'affiche dans une tab des settings du theme pour voir (et pour le fun :))
					const obj = JSON.stringify(donnees);
					document.getElementById('lemonApps').innerHTML = '<pre>' + obj + '</pre>';

					// TODO générer un menu dans une div en dessous avec les catégories + lien clicable appli
					// div #menuTestLemon

					


				}
			});


		});
	}
  };
})(jQuery, Drupal, drupalSettings);
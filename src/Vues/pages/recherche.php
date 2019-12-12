<?php $titre = "Page de recherche" ?>

<h1>Page de recherche</h1>

<form action="index.php?page=rechercher" method="get">
	<label for="recherche">Ce que vous voulez</label>
	<input type="text" id="recherche" name="recherche">
</form>

<div id="affichage"></div>

<script>

	document.querySelector('#recherche').addEventListener('keyup', event => {
		console.log(event.target.value)

		if(!event.target.value) {
			document.querySelector('#affichage').innerHTML = ''
			return 0
		}

		let recherche = fetch('index.php?page=rechercher&q=' + event.target.value)
		.then(response => response.json())
		.then(json => {

			let html = "<ul>";
			Object.keys(json).forEach(j => {
				html += "<li><a href='index.php?page=ajouter_recette&id=" + j + "'>" + json[j] + "</a></li>"
			})

			document.querySelector('#affichage').innerHTML = html
		})
	});



</script>

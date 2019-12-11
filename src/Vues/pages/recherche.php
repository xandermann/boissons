<?php $titre = "Page de recherche" ?>

<h1>Page de recherche</h1>

<form action="index.php?page=rechercher" method="get">

	<label for="recherche">Ce que vous voulez</label>
	<input type="text" id="recherche" name="recherche">

	<input type="submit" value="Rechercher">
</form>

<div id="affichage"></div>



<script>

	document.querySelector('#recherche').addEventListener('keyup', event => {
		let recherche = fetch('index.php?page=rechercher&q=' + event.target.value)
		.then(response => response.json())
		.then(json => {

			let html = "";
			Object.keys(json).forEach(j => {
				html += json[j] + '<br>';
			})

			document.querySelector('#affichage').innerHTML = html
		})
	});



</script>

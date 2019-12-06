<?php $titre = "Page de recherche" ?>

<h1>Page de recherche</h1>

<form action="index.php?page=rechercher" method="get">

	<label for="pseudo">Ce que vous voulez</label>
	<input type="text" id="veut" name="veut">

	<label for="mdp">Ce que vous ne voulez pas</label>
	<input type="text" id="veut_pas" name="veut_pas">

	<input type="submit" value="Rechercher">

</form>

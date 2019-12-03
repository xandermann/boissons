<form action="index.php?page=ajouter_utilisateur" method="post">

	<label for="pseudo">Pseudo</label>
	<input type="text" id="pseudo" name="pseudo" required>

	<label for="mdp">Mot de passe</label>
	<input type="password" id="mdp" name="mdp" required>

	<label for="mdp2">Confirmation mot de passe</label>
	<input type="password" id="mdp2" name="mdp2" required>

	<label for="nom">Nom</label>
	<input type="text" id="nom" name="nom">

	<label for="prenom">Prenom</label>
	<input type="text" id="Prenom" name="prenom">

	<label for="sexe">sexe</label>
	<input type="radio" id="masc" name="sexe">
	<input type="radio" id="fem" name="sexe">

	<label for="mail">Adresse mail</label>
	<input type="text" id="mail" name="mail">

	<label for="naiss">Date de naisance</label>
	<input type="date" id="naissance" name="naiss">

	<label for="codeP">Code postal</label>
	<input type="text" id="code" name="code">

	<label for="tel">Téléphone</label>
	<input type="text" id="telephone" name="tel">

	<input type="submit" value="Valider inscription">

</form>

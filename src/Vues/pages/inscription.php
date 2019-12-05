<form action="index.php?page=ajouter_utilisateur" method="post">

	<label for="pseudo">Pseudo</label>
	<input type="text" id="pseudo" name="pseudo" required autofocus>

	<label for="mdp">Mot de passe</label>
	<input type="password" id="mdp" name="mdp" required>

	<label for="mdp2">Confirmation mot de passe</label>
	<input type="password" id="mdp2" name="mdp2" required>

	<label for="nom">Nom</label>
	<input type="text" id="nom" name="nom">

	<label for="prenom">Prenom</label>
	<input type="text" id="prenom" name="prenom">

	<label for="homme">Homme</label>
	<input type="radio" id="homme" name="sexe" value="h" checked>
	<label for="femme">Femme</label>
	<input type="radio" id="femme" name="sexe" value="f">

	<label for="mail">Adresse mail</label>
	<input type="text" id="mail" name="mail">

	<label for="naissance">Date de naisance</label>
	<input type="date" id="naissance" name="date_naissance">

	<label for="codeP">Code postal</label>
	<input type="text" id="codeP" name="code_postal">

	<label for="telephone">Téléphone</label>
	<input type="text" id="telephone" name="telephone">

	<input type="submit" value="Valider inscription">

</form>

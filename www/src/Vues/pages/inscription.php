<form action="index.php?page=ajouter_utilisateur" method="post">

	<?php if(isset($_SESSION['flash']['pseudo'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['pseudo']['message'] ?></div>
	<?php endif ?>

	<label for="pseudo">Pseudo</label>
	<input type="text" id="pseudo" name="pseudo" required autofocus>

	<?php if(isset($_SESSION['flash']['mot_de_passe'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['mot_de_passe']['message'] ?></div>
	<?php endif ?>
	<label for="mot_de_passe">Mot de passe</label>
	<input type="password" id="mot_de_passe" name="mot_de_passe" required>

	<label for="mot_de_passe_2">Confirmation mot de passe</label>
	<input type="password" id="mot_de_passe_2" name="mot_de_passe_2" required>


	<?php if(isset($_SESSION['flash']['nom'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['nom']['message'] ?></div>
	<?php endif ?>
	<label for="nom">Nom</label>
	<input type="text" id="nom" name="nom">


	<?php if(isset($_SESSION['flash']['prenom'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['prenom']['message'] ?></div>
	<?php endif ?>
	<label for="prenom">Prenom</label>
	<input type="text" id="prenom" name="prenom">

	<?php if(isset($_SESSION['flash']['sexe'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['sexe']['message'] ?></div>
	<?php endif ?>
	<label for="homme">Homme</label>
	<input type="radio" id="homme" name="sexe" value="homme">
	<label for="femme">Femme</label>
	<input type="radio" id="femme" name="sexe" value="femme">

	<?php if(isset($_SESSION['flash']['mail'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['mail']['message'] ?></div>
	<?php endif ?>
	<label for="mail">Adresse mail</label>
	<input type="text" id="mail" name="mail">

	<?php if(isset($_SESSION['flash']['naissance'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['naissance']['message'] ?></div>
	<?php endif ?>
	<label for="naissance">Date de naisance</label>
	<input type="date" id="naissance" name="naissance">

	<?php if(isset($_SESSION['flash']['adresse'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['adresse']['message'] ?></div>
	<?php endif ?>
	<label for="adresse">Adresse</label>
	<input type="text" id="adresse" name="adresse">

	<?php if(isset($_SESSION['flash']['code_postal'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['code_postal']['message'] ?></div>
	<?php endif ?>
	<label for="codeP">Code postal</label>
	<input type="text" id="codeP" name="code_postal">

	<?php if(isset($_SESSION['flash']['ville'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['ville']['message'] ?></div>
	<?php endif ?>
	<label for="ville">Ville</label>
	<input type="text" id="ville" name="ville">

	<?php if(isset($_SESSION['flash']['telephone'])): ?>
		<div class="erreur"><?= $_SESSION['flash']['telephone']['message'] ?></div>
	<?php endif ?>
	<label for="telephone">Téléphone</label>
	<input type="text" id="telephone" name="telephone">

	<input type="submit" value="Valider inscription">

</form>

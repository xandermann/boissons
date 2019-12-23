<!doctype html>
<html lang="fr">
<head>
	<title><?= $titre ?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<nav>
		<ul>
			<li><a href="index.php?page=accueil">Page accueil</a></li>
			<li><a href="index.php?page=recette">Mes recettes preferees</a></li>
			<li><a href="index.php?page=recherche">Recherche</a></li>

			<?php if (!isset($_SESSION['utilisateur_id'])){ ?>
				<li><a href="index.php?page=connexion">Connexion</a></li>
				<li><a href="index.php?page=inscription">Inscription</a></li>
			<?php } else{ ?>
				<li><a href="?page=voir_utilisateur"><?= $_SESSION['utilisateur_pseudo'] ?></a></li>
				<li><a href="?page=se_deconnecter">Deconnexion</a></li>
			<?php } ?>
		</ul>
	</nav>

	<?php // Message flash ?>
	<?php if (($_SESSION['flash'][0]['status'] ?? false) == 'succes'): ?>
		<div class="succes"><?= $_SESSION['flash'][0]['message'] ?></div>
	<?php endif ?>

	<?php if (($_SESSION['flash'][0]['status'] ?? false) == 'erreur'): ?>
		<div class="erreur"><?= $_SESSION['flash'][0]['message'] ?></div>
	<?php endif ?>

	<div class="contenu">
		<?= $content ?>
	</div>
</body>
</html>

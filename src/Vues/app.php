<!doctype html>
<html lang="fr">
<head>
	<title><?= $titre ?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<?php
	$page = $_GET['page'] ?? '';
	?>

	<nav>
		<ul>
			<li><a <?php if($page == 'accueil') { ?>class="active"<?php } ?> href="index.php?page=accueil">Accueil</a></li>
			<li><a <?php if($page == 'recette') { ?>class="active"<?php } ?> href="index.php?page=recette">Mes recettes preferees</a></li>
			<li><a <?php if($page == 'recherche') { ?>class="active"<?php } ?> href="index.php?page=recherche">Rechercher</a></li>

			<?php if (!isset($_SESSION['utilisateur_id'])){ ?>
				<li class="droite"><a <?php if($page == 'inscription') { ?>class="active"<?php } ?> href="index.php?page=inscription">Inscription</a></li>
				<li class="droite"><a <?php if($page == 'connexion') { ?>class="active"<?php } ?> href="index.php?page=connexion">Connexion</a></li>
			<?php } else{ ?>
				<li class="droite"><a <?php if($page == 'se_deconnecter') { ?>class="active"<?php } ?> href="?page=se_deconnecter">Deconnexion</a></li>
				<li class="droite"><a <?php if($page == 'voir_utilisateur') { ?>class="active"<?php } ?> href="?page=voir_utilisateur"><?= $_SESSION['utilisateur_pseudo'] ?></a></li>
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

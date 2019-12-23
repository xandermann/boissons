<!doctype html>
<html lang="fr">
<head>
	<title><?= $titre ?></title>
	<style>
		html, body {
			margin: 0;
		}
		nav {
			margin-bottom: 100px;
			border-top: 10px solid #2196f3;
			background-color: #6ec6ff;
			padding: 3px 0;
		}
		nav ul {
			display: flex;
			justify-content: space-around;
			list-style-type: none
		}
		nav ul li a {
			box-sizing: border-box;
			padding: 17px;
			border: 1px solid black;
			color: black;
		}

		.box {
			border: 1px solid black;
			margin: 10px 0;
		}

		input {
			display: block;
			text-align: center;
			margin: 0 auto;
		}

		label {
			display: block;
			text-align: center;
			border-bottom: 5px;
		}

		.succes {
			background-color: green;
		}

		.erreur {
			background-color: red;
		}

		.contenu {
			border: 1px solid black;
			margin: 0 auto;
			width: 1000px;
		}

		.contenu img {
			max-width: 300px;
			display: inline;
			margin: 0 auto;
		}
	</style>
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
				<li><a href=""><?= $_SESSION['utilisateur_pseudo'] ?></a></li>
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

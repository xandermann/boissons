<!doctype html>
<html lang="fr">
<head>
	<title><?= $title ?></title>
	<style>
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
	</style>
</head>
<body>

	<nav>
		<ul>
			<li><a href="index.php?page=accueil">Page accueil</a></li>
			<li><a href="index.php?page=recette">Mes recettes preferees</a></li>
			<li><a href="index.php?page=connexion">Connexion</a></li>
			<li><a href="index.php?page=inscription">Inscription</a></li>
		</ul>
	</nav>

	<?= $content ?>
</body>
</html>

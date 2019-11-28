<?php

require('../src/Donnees.inc.php');


$categorie = $_GET['categorie'] ?? 'Aliment';
$hierarchie = $Hierarchie[$categorie] ?? header('Location: index.php?page=accueil&categorie=Aliment');
?>

<h1><?= $categorie ?></h1>


<ul>
<?php foreach($hierarchie as $nom => $h): ?>
	<li><?= $nom ?>
		<ul>
			<?php foreach($h as $id => $categorie): ?>
				<li>ID:<?= $id ?> - <?= $categorie ?> <a href="index.php?page=accueil&categorie=<?= $categorie ?>">LIEN</a></li>
			<?php endforeach ?>
		</ul>
	</li>
<?php endforeach ?>
</ul>


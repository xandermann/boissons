<?php

require('../src/Donnees.inc.php');

?>

<h1><?= $_GET['categorie'] ?></h1>

<hr>

<?php
$categorie = $_GET['categorie'] ?? 'Aliment';
$hierarchie = $Hierarchie[$categorie] ?? header('Location: index.php?categorie=Aliment');
?>



<ul>
<?php foreach($hierarchie as $nom => $h): ?>
	<li><?= $nom ?>
		<ul>
			<?php foreach($h as $id => $categorie): ?>
				<li>ID:<?= $id ?> - <?= $categorie ?> <a href="index.php?categorie=<?= $categorie ?>">LIEN</a></li>
			<?php endforeach ?>
		</ul>
	</li>
<?php endforeach ?>
</ul>

<?php
die;

?>
<?= var_dump($Hierarchie[$categorie] ?? '') ?>


<ul>
    <?php foreach($Hierarchie as $nom => $hierarchie): ?>
        <li>Le nom est: "<?= $nom ?>"</li>
        <li>Sous catégorie:
            <ul>
                <?php foreach($hierarchie['sous-categorie'] ?? [] as $sousCategorie): ?>
                    <li><?= $sousCategorie ?></li>
                <?php endforeach ?>
            </ul>
        </li>

        <li>Super catégorie:
            <ul>
                <?php foreach($hierarchie['super-categorie'] ?? [] as $superCategorie): ?>
                    <li><?= $superCategorie ?></li>
                <?php endforeach ?>
            </ul>
        </li>

        <hr>
    <?php endforeach ?>
</ul>

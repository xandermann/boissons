<h1>Mes recettes preferees</h1>

<?php if(count($recettes) > 0){ ?>
	<hr>
	<ul>
		<?php foreach($recettes as $id => $recette): ?>
			<li>
				<h2><?= $recette['titre'] ?></h2>
				<p><a href="?page=voir_recette&id=<?= $id ?>">Voir la recette <?= $recette['titre'] ?></a></p>
				<p><a href="index.php?page=supprimer_recette&id=<?= $id ?>">Supprimer</a></p>
				<p><hr></p>
			</li>
		<?php endforeach ?>
	</ul>

	<a href="?page=supprimer_recettes">Supprimer toutes les recettes</a>


<?php } else { ?>

	<h3>Pas de recette preferées :(</h3>

<?php } ?>

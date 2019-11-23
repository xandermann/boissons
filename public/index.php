<?php

require('../src/Donnees.inc.php');

?>

<!--
<ul>
    <?php foreach($Recettes as $r): ?>
        <li><?php var_dump($r) ?></li>
    <?php endforeach ?>
</ul>
-->

<hr>


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
<?php

namespace App\Controllers;

use App\Controllers\Controller;

class RechercheController extends Controller {

	public function recherche() {

		require('../src/Modeles/Donnees.inc.php');

		$liste_ingredients = array_map(function($recette) {
			return $recette['index'];
		}, $Recettes);

		$liste_ingredients_tab = $liste_ingredients[0];
		foreach($liste_ingredients as $ingredients) {
			$liste_ingredients_tab = array_merge($liste_ingredients_tab, $ingredients);
		}

		$ingredients = array_unique($liste_ingredients_tab);

		$this->render('recherche', compact('ingredients'));
	}

	public function rechercher() {
		require('../src/Modeles/Donnees.inc.php');
		//header('Content-Type: application/json');

		$recherche = $_GET['q'] ?? '';
		$ingredientsDansLarecherche = explode(",", $recherche);

		// Ici on trie (fonction recherche)
		$resultat = array_filter($Recettes, function($recette) use ($ingredientsDansLarecherche) {


			// $ingredientsDansLarecherche <- C'est un tableau qui contient tout les ingredients qu'on cherche
			// ingredientsDansLaRecette <- Liste des ingredients dans la recette
			$ingredientsDansLaRecette = $recette['index'];


			// Pour chaque ingredient dans la recherche
			foreach($ingredientsDansLarecherche as $ingredient) {


				if(!preg_match('/^Pas de ([a-z]+)/', $ingredient, $match)) {

					// Si on veut l'ingredient, si il est pas dans la recette, on prend pas
					if (!in_array($ingredient, $ingredientsDansLaRecette)) {
						return false;
					}
				} else {

					$ingredient = ucfirst($match[1]);

					if (in_array($ingredient, $ingredientsDansLaRecette)) {
						return false;
					}
					// Commence par 'Pas de '
					//var_dump($ingredientsDansLaRecette, $match[1]);

				}
			}
			return true;
		});

		//var_dump($resultat);

		// Ici, on renvoie seulement le titre
		$resultat = array_map(function($recette) {
			return $recette['titre'];
		}, $resultat);

		echo json_encode($resultat);

	}

}

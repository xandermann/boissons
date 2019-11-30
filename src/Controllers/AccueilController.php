<?php

namespace App\Controllers;

use App\Controllers\Controller;

class AccueilController extends Controller {

	public function accueil() {

		require('../src/Modeles/Donnees.inc.php');

		$categorie = $_GET['categorie'] ?? 'Aliment';
		$hierarchie = $Hierarchie[$categorie] ?? header('Location: index.php?page=accueil&categorie=Aliment');

		$recettes = $Recettes; // On va trier les recettes ici

		return $this->render('accueil', compact('categorie', 'hierarchie', 'recettes'));
	}

}

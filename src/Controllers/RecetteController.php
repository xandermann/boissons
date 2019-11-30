<?php

namespace App\Controllers;

use App\Controllers\Controller;

class RecetteController extends Controller {

	public function index() {
		return $this->render('recettesPreferees');
	}

	public function ajouter() {
		require('../src/Modeles/Donnees.inc.php');
		$id = $_GET['id']; // A valider
		$recette = $Recettes[$id]; // A verifier

		var_dump($recette);
		echo "TODO: A ajouter aux recettes";
	}

}

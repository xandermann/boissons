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
		$recette = $Recettes[$id]; // A verifier si la recette existe

		if(!isset($_SESSION['recettes'])) {
			$_SESSION['recettes'] = [];
		}

		array_push($_SESSION['recettes'], $id); // A verifier si elle existe déjà

		$this->redirect('index.php?page=accueil', $this->SUCCES, 'La recette est bien ajoutée !');
	}

}

<?php

namespace App\Controllers;

use App\Controllers\Controller;

class AccueilController extends Controller {

	public function __construct() {

	}

	public function index() {

		require('../src/Modeles/Donnees.inc.php');

		$categorie = $_GET['categorie'] ?? 'Aliment';
		$hierarchie = $Hierarchie[$categorie] ?? header('Location: index.php?page=accueil&categorie=Aliment');

		return $this->render('accueil', compact('categorie', 'hierarchie'));
	}

}

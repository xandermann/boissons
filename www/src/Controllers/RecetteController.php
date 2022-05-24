<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Classes\DB;

class RecetteController extends Controller {

	public function index() {
		require('../src/Modeles/Donnees.inc.php');

		$recettes = [];
		foreach(($_SESSION['recettes'] ?? []) as $recette_id) {
			$recettes[$recette_id] = $Recettes[$recette_id];
			//array_push($recettes, $Recettes[$recette_id]);
		}

		return $this->render('recette', compact('recettes'));
	}

	public function ajouter() {
		require('../src/Modeles/Donnees.inc.php');
		$id = $_GET['id']; // A valider
		$recette = $Recettes[$id]; // TODO A verifier si la recette existe

		if(!isset($_SESSION['recettes'])) {
			$_SESSION['recettes'] = [];
		}

		if (isset($_SESSION['utilisateur_id'])) { // On ajoute dans la table si l'utilisateur est connecté
			$bdd = DB::getInstance();
			$req = $bdd->prepare('INSERT INTO recettes(id, utilisateur_id) VALUES (?, ?)');
			$req->execute([$id, $_SESSION['utilisateur_id']]);
		}

		array_push($_SESSION['recettes'], $id); // TODO A verifier si elle existe déjà
		// TODO si l'utilisateur est connecté, alors ajoute les recettes en BDD

		$this->redirect(false, $this->SUCCES, 'La recette est bien ajoutée !');
	}

	public function supprimer() {
		$id = $_GET['id']; // A verifier

		// Supprime la cle dans la session
		$_SESSION['recettes'] = array_filter($_SESSION['recettes'], function($recette) use ($id) {
			return $recette != $id;
		});

		if (isset($_SESSION['utilisateur_id'])) {
			$bdd = DB::getInstance();
			$req = $bdd->prepare('DELETE FROM recettes WHERE id=? AND utilisateur_id=?');
			$req->execute([$id,$_SESSION['utilisateur_id']]);
		}

		$this->redirect('recette', $this->SUCCES, "La recette $id a ete supprimee de vos recettes");
	}

	public function supprimerTout() {
		$_SESSION['recettes'] = [];

		if (isset($_SESSION['utilisateur_id'])) {
			$bdd = DB::getInstance();
			$req = $bdd->prepare('DELETE FROM recettes WHERE utilisateur_id=?');
			$req->execute([$_SESSION['utilisateur_id']]);
		}

		$this->redirect('recette', $this->SUCCES, "Toutes vos recettes ont été supprimées !");
	}

	public function voir() {
		require('../src/Modeles/Donnees.inc.php');


		$id = $_GET['id'];

		$recette = $Recettes[$id] ?? $this->redirect('accueil', $this->ERREUR, 'Pas de recettes existantes.');

		$this->render('voir_recette', compact('recette', 'id'));

	}

}

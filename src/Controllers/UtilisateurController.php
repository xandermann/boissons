<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Classes\DB;

class UtilisateurController extends Controller {

	public function connexion() {
		$this->render('connexion');
	}

	public function inscription() {
		$this->render('inscription');
	}

	public function ajouterUtilisateur() {
		$bdd = DB::getInstance();

		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$mdp2 = $_POST['mdp2']; // A verifier
		// Attention chiffrer le MDP !!! TODO

		var_dump($pseudo, $mdp, $mdp2);
		$req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mdp) VALUES(?, ?)');
		$req->execute([$pseudo, $mdp]);

		$this->redirect('connexion', $this->SUCCES, 'Bravo ! L\'inscription à été réussie !');
	}

	public function seConnecter() {
		$bdd = DB::getInstance();

		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];

		$donnees = $bdd->query("SELECT id,pseudo FROM utilisateurs WHERE pseudo='$pseudo' AND mdp='$mdp' LIMIT 1")->fetchAll();

		if (!empty($donnees)) {
			$_SESSION['utilisateur_id'] = $donnees[0]['id'];
			$_SESSION['utilisateur_pseudo'] = $donnees[0]['pseudo'];
		} else {
			$this->redirect("inscription", $this->ERREUR, 'Identifiants inconnects !');
		}

		$this->redirect('accueil', $this->SUCCES, 'Connexion réussie !');
	}

	public function seDeconnecter() {
		unset($_SESSION['utilisateur_id']);
		$this->redirect(false, $this->SUCCES, 'Deconnexion réussie !');
	}

}

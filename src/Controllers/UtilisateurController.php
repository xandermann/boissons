<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Classes\DB;
use App\Classes\Validator;
use App\Classes\ValidatorException;

class UtilisateurController extends Controller {

	public function connexion() {
		$this->render('connexion');
	}

	public function inscription() {
		$this->render('inscription');
	}

	public function ajouterUtilisateur() {
		$bdd = DB::getInstance();

		$validator = Validator::valider([
			'pseudo' => Validator::CHAINE,
			'mdp' => Validator::MDP,
			'mdp2' => Validator::MDP,
		]);

		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$mdp2 = $_POST['mdp2']; // A verifier
		// Attention chiffrer le MDP !!! TODO

		var_dump($validator);
		die;

		var_dump($pseudo, $mdp, $mdp2);
		$req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mdp) VALUES(?, ?)');
		$req->execute([$pseudo, $mdp]);

		$this->redirect('connexion', $this->SUCCES, 'Bravo ! L\'inscription à été réussie !');
	}

	public function seConnecter() {
		$bdd = DB::getInstance();

		try {
			$validator = Validator::valider([
				'pseudo' => Validator::CHAINE,
				'mdp' => Validator::MOT_DE_PASSE,
			]);
		} catch(ValidatorException $e) {
			$this->redirect('connexion', 'erreur', 'Verifiez que vos identifiants sont bien entrées');
		}

		// TODO Ajouter les recettes de l'utilisateur en BDD à la session
		$req = $bdd->prepare('SELECT id,pseudo FROM utilisateurs WHERE pseudo=? and mdp=? LIMIT 1');
		$req->execute([$validator['pseudo'], $validator['mdp']]);
		$donnees = $req->fetchAll();

		if(empty($donnees)) {
			$this->redirect("connexion", $this->ERREUR, 'Identifiants inconnects !');
		}

		$_SESSION['utilisateur_id'] = $donnees[0]['id'];
		$_SESSION['utilisateur_pseudo'] = $donnees[0]['pseudo'];
		$this->redirect('accueil', $this->SUCCES, 'Connexion réussie !');
	}

	public function seDeconnecter() {
		unset($_SESSION['utilisateur_id']);
		$this->redirect(false, $this->SUCCES, 'Deconnexion réussie !');
	}

}

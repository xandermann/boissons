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
			'mdp' => Validator::MOT_DE_PASSE,
			'mdp2' => Validator::CHAINE, // Pas besoin de vérifié ici car on l'a déjà fait sur mdp
		]);

		if ($validator['mdp'] != $validator['mdp2']) {
			$this->redirect('inscription', $this->ERREUR, 'Mot de passe différents');
		}

		$req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mdp) VALUES(?, ?)');
		$req->execute([$validator['pseudo'], password_hash($validator['mdp'], PASSWORD_DEFAULT)]);

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

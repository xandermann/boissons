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

			'nom' => Validator::CHAINE_NULLABLE,
			'prenom' => Validator::CHAINE_NULLABLE,
			'sexe' => Validator::SEXE_NULLABLE,
			'mail' => Validator::EMAIL_NULLABLE,
			'date_naissance' => Validator::DATE_NAISSANCE_NULLABLE,
			'code_postal' => Validator::CODE_POSTAL_NULLABLE,
			'telephone' => Validator::TELEPHONE_NULLABLE,
		]);

		if ($validator['mdp'] != $validator['mdp2']) {
			$this->redirect('inscription', $this->ERREUR, 'Mot de passe différents');
		}

		$req = $bdd->prepare('SELECT pseudo FROM utilisateurs WHERE pseudo=? LIMIT 1');
		$req->execute([$validator['pseudo']]);
		$donnee = $req->fetch();
		if(!empty($donnee)) {
			$this->redirect('inscription', $this->ERREUR, 'Un utilisateur avec le même pseudo existe déjà');
		}

		$req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mdp, nom, prenom, sexe, email, naissance, code_postal, tel) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');

		$req->execute([
			$validator['pseudo'],
			password_hash($validator['mdp'], PASSWORD_DEFAULT),
			$validator['nom'],
			$validator['prenom'],
			$validator['sexe'],
			$validator['mail'],
			$validator['date_naissance'],
			$validator['code_postal'],
			$validator['telephone'],
		]);

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
		$req = $bdd->prepare('SELECT id,pseudo,mdp FROM utilisateurs WHERE pseudo=? LIMIT 1');
		$req->execute([$validator['pseudo']]);
		$donnees = $req->fetchAll();

		if(empty($donnees)) {
			$this->redirect("connexion", $this->ERREUR, 'Pseudo inconnu');
		}

		if(!password_verify($validator['mdp'], $donnees[0]['mdp'])) {
			$this->redirect("connexion", $this->ERREUR, 'Mot de passe incorrect');
		}

		$_SESSION['utilisateur_id'] = $donnees[0]['id'];
		$_SESSION['utilisateur_pseudo'] = $donnees[0]['pseudo'];


		// On merge les recettes qu'il a, s'il en a
		if (isset($_SESSION['recettes'])) {
			$recettes = $_SESSION['recettes'];

			foreach($recettes as $recette) {
				$req = $bdd->prepare('INSERT INTO recettes(id, utilisateur_id) VALUES (?,?)');
				$req->execute([$recette,$_SESSION['utilisateur_id']]);
			}
		}

		// On ajoute les recettes qu'il a
		$req = $bdd->prepare('SELECT id FROM recettes WHERE utilisateur_id=?');
		$req->execute([$_SESSION['utilisateur_id']]);
		$reponses = $req->fetchAll();

		$_SESSION['recettes'] = $_SESSION['recettes'] ?? [];
		foreach($reponses as $reponse) {
			if (!in_array($reponse['id'], $_SESSION['recettes'])) {
				array_push($_SESSION['recettes'], $reponse['id']);
			}
		}

		$this->redirect('accueil', $this->SUCCES, 'Connexion réussie !');
	}

	public function seDeconnecter() {
		if(!isset($_SESSION['utilisateur_id'])) {
			$this->redirect('accueil', $this->ERREUR, 'Vous êtes déjà déconnecté !');
		}
		unset($_SESSION['utilisateur_id']);
		unset($_SESSION['recettes']);
		$this->redirect(false, $this->SUCCES, 'Deconnexion réussie !');
	}

}

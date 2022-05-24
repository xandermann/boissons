<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Classes\DB;
use App\Classes\Validator;
use App\Classes\ValidatorException;
use App\Classes\Flash;

class UtilisateurController extends Controller {

	public function connexion() {
		$this->render('connexion');
	}

	public function inscription() {
		$this->render('inscription');
	}

	public function ajouterUtilisateur() {
		$pseudo = $_POST['pseudo'] ?? null;
		$mot_de_passe = $_POST['mot_de_passe'] ?? null;
		$mot_de_passe_2 = $_POST['mot_de_passe_2'] ?? null;

		$is_erreur = false;

		// On verifie les champs postés
		if (is_null($pseudo)) {
			Flash::ajouterErreur('pseudo', 'Le pseudo est vide !');
			$is_erreur = true;
		}

		if (is_null($mot_de_passe)) {
			Flash::ajouterErreur('mot_de_passe', 'Le mot de passe est vide !');
			$is_erreur = true;
		}

		if (is_null($mot_de_passe_2)) {
			Flash::ajouterErreur('mot_de_passe_2', 'La confirmation du mot de passe est vide !');
			$is_erreur = true;
		}

		// Ensuite
		// On teste le pseudo
		if (!preg_match('/^[a-zA-Z0-9]{1,16}$/', $pseudo)) {
			Flash::ajouterErreur('pseudo', 'Le format du pseudo est incorrect (1 caracteres minimum et 16 caracteres maximum)');
			$is_erreur = true;
		}

		// On teste le pseudo
		if (!preg_match('/^[a-zA-Z0-9]{4,99}$/', $mot_de_passe)) {
			Flash::ajouterErreur('mot_de_passe', 'Le mot de passe doit faire 4 caracteres minimum');
			$is_erreur = true;
		}

		if ($mot_de_passe != $mot_de_passe_2) {
			Flash::ajouterErreur('mot_de_passe', 'Les mots de passe doivent être identiques');
			$is_erreur = true;
		}


		$nom = $_POST['nom'] ?? null;
		if($nom) {
			if(!preg_match('/^[a-zA-Z0-9\-]{1,30}$/', $nom)) {
				Flash::ajouterErreur('nom', 'Le format du nom est incorrect');
				$is_erreur = true;
			}
		}

		$prenom = $_POST['prenom'] ?? null;
		if($prenom) {
			if(!preg_match('/^[a-zA-Z0-9\-]{1,30}$/', $prenom)) {
				Flash::ajouterErreur('prenom', 'Le format du prenom est incorrect');
				$is_erreur = true;
			}
		}

		$sexe = $_POST['sexe'] ?? null;
		if($sexe) {
			if($sexe != 'homme' && $sexe != 'femme') {
				Flash::ajouterErreur('sexe', 'Le format du sexe est incorrect');
				$is_erreur = true;
			}
		}

		$mail = $_POST['mail'] ?? null;
		if($mail) {
			if(!preg_match('/^[a-zA-Z0-9\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-]+$/', $mail) || strlen($mail) > 100) {
				Flash::ajouterErreur('mail', 'Le format du mail est incorrect');
				$is_erreur = true;
			}
		}

		$naissance = $_POST['naissance'] ?? null;
		if($naissance) {
			if(!preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $naissance)) {
				Flash::ajouterErreur('naissance', 'Le format de la date de naissance est incorrecte');
				$is_erreur = true;
			}
		}

		$naissance = $_POST['naissance'] ?? null;
		if($naissance) {
			if(!preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $naissance) || strtotime($naissance) > time()) {
				Flash::ajouterErreur('naissance', 'Le format de la date de naissance est incorrecte');
				$is_erreur = true;
			}
		}

		$adresse = $_POST['adresse'] ?? null;
		if($adresse) {
			if(strlen($adresse) > 60) {
				Flash::ajouterErreur('adresse', 'Adresse invalide');
				$is_erreur = true;
			}
		}

		$code_postal = $_POST['code_postal'] ?? null;
		if($code_postal) {
			if(!preg_match('/^[0-9]{5}$/', $code_postal)) {
				Flash::ajouterErreur('code_postal', 'Adresse invalide');
				$is_erreur = true;
			}
		}

		$ville = $_POST['ville'] ?? null;
		if($code_postal) {
			if(strlen($ville) > 50) {
				Flash::ajouterErreur('ville', 'Adresse invalide');
				$is_erreur = true;
			}
		}

		$telephone = $_POST['telephone'] ?? null;
		if($telephone) {
			if(!preg_match('/^[0-9]{10}$/', $telephone)) {
				Flash::ajouterErreur('telephone', 'Telephone invalide (10 chiffres)');
				$is_erreur = true;
			}
		}



		if($is_erreur) {
			$this->redirect(null);
		}

		$bdd = DB::getInstance();

		$req = $bdd->prepare('SELECT pseudo FROM utilisateurs WHERE pseudo=? LIMIT 1');
		$req->execute([$pseudo]);
		$donnee = $req->fetch();
		if(!empty($donnee)) {
			$this->redirect(null, $this->ERREUR, 'Un utilisateur avec le même pseudo existe déjà');
		}


		$req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mot_de_passe, nom, prenom, sexe, email, adresse, ville, code_postal, naissance, telephone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

		// Fixe un probleme de date
		if($naissance == '') {
			$naissance = null;
		}

		$req->execute([
			$pseudo,
			password_hash($mot_de_passe, PASSWORD_DEFAULT),
			$nom,
			$prenom,
			$sexe,
			$mail,
			$adresse,
			$ville,
			$code_postal,
			$naissance,
			$telephone,
		]);

		$this->redirect('connexion', $this->SUCCES, 'Bravo ! L\'inscription à été réussie !');
	}




	public function seConnecter() {
		$bdd = DB::getInstance();

		$pseudo = $_POST['pseudo'] ?? null;

		// TODO Ajouter les recettes de l'utilisateur en BDD à la session
		$req = $bdd->prepare('SELECT id,pseudo,mot_de_passe FROM utilisateurs WHERE pseudo=? LIMIT 1');
		$req->execute([$pseudo]);
		$donnees = $req->fetchAll();

		if(empty($donnees)) {
			$this->redirect("connexion", $this->ERREUR, 'Pseudo inconnu');
		}

		if(!password_verify($_POST['mot_de_passe'], $donnees[0]['mot_de_passe'])) {
			$this->redirect("connexion", $this->ERREUR, 'Mot de passe incorrect');
		}

		$_SESSION['utilisateur_id'] = $donnees[0]['id'];
		$_SESSION['utilisateur_pseudo'] = $donnees[0]['pseudo'];

		/*
		// On merge les recettes qu'il a, s'il en a
		if (isset($_SESSION['recettes'])) {
			$recettes = $_SESSION['recettes'];

			foreach($recettes as $recette) {
				$req = $bdd->prepare('INSERT INTO recettes(id, utilisateur_id) VALUES (?,?)');
				$req->execute([$recette,$_SESSION['utilisateur_id']]);
			}
		}
		*/
		unset($_SESSION['recettes']);

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

	public function voirUtilisateur() {
		$connecte = $_SESSION['utilisateur_id'] ?? null;

		if(!$connecte) {
			$this->redirect('accueil');
		}

		$bdd = DB::getInstance();
		$req = $bdd->prepare('select * from utilisateurs where id=? limit 1');
		$req->execute([$connecte]);


		$utilisateur = $req->fetchAll();

		if(empty($utilisateur)) {
			$this->redirect('accueil', $this->ERREUR, 'Erreur');
		}

		$utilisateur = $utilisateur[0];

		$this->render('voir_utilisateur', compact('utilisateur'));
	}

	public function modifierUtilisateur() {
		$connecte = $_SESSION['utilisateur_id'] ?? null;

		if(!$connecte) {
			$this->redirect('accueil');
		}

		// $mot_de_passe = $_POST['mot_de_passe'] ?? null;
		// $mot_de_passe_2 = $_POST['mot_de_passe_2'] ?? null;

		$nom = $_POST['nom'] ?? null;
		$prenom = $_POST['prenom'] ?? null;
		$sexe = $_POST['sexe'] ?? null;
		$email = $_POST['email'] ?? null;
		$adresse = $_POST['adresse'] ?? null;
		$ville = $_POST['ville'] ?? null;
		$code_postal = $_POST['code_postal'] ?? null;
		$naissance = $_POST['naissance'] ?? null;
		$telephone = $_POST['telephone'] ?? null;

		//if($mot_de_passe !=)
		$is_erreur = false;


		// if (!preg_match('/^[a-zA-Z0-9]{4,99}$/', $mot_de_passe)) {
		// 	Flash::ajouterErreur('mot_de_passe', 'Le mot de passe doit faire 4 caracteres minimum');
		// 	$is_erreur = true;
		// }

		$nom = $_POST['nom'] ?? null;
		if($nom) {
			if(!preg_match('/^[a-zA-Z0-9\-]{1,30}$/', $nom)) {
				Flash::ajouterErreur('nom', 'Le format du nom est incorrect');
				$is_erreur = true;
			}
		}

		$prenom = $_POST['prenom'] ?? null;
		if($prenom) {
			if(!preg_match('/^[a-zA-Z0-9\-]{1,30}$/', $prenom)) {
				Flash::ajouterErreur('prenom', 'Le format du prenom est incorrect');
				$is_erreur = true;
			}
		}

		$sexe = $_POST['sexe'] ?? null;
		if($sexe) {
			if($sexe != 'homme' && $sexe != 'femme') {
				Flash::ajouterErreur('sexe', 'Le format du sexe est incorrect');
				$is_erreur = true;
			}
		}

		$mail = $_POST['mail'] ?? null;
		if($mail) {
			if(!preg_match('/^[a-zA-Z0-9\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-]+$/', $mail) || strlen($mail) >= 100) {
				Flash::ajouterErreur('mail', 'Le format du mail est incorrect');
				$is_erreur = true;
			}
		}

		$naissance = $_POST['naissance'] ?? null;

		if($naissance) {
			if(!preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $naissance) || strtotime($naissance) > time()) {
				Flash::ajouterErreur('naissance', 'Le format de la date de naissance est incorrecte');
				$is_erreur = true;
			}
		}

		$adresse = $_POST['adresse'] ?? null;
		if($adresse) {
			if(strlen($adresse) > 60) {
				Flash::ajouterErreur('adresse', 'Adresse invalide');
				$is_erreur = true;
			}
		}

		$code_postal = $_POST['code_postal'] ?? null;
		if($code_postal) {
			if(!preg_match('/^[0-9]{5}$/', $code_postal)) {
				Flash::ajouterErreur('code_postal', 'Adresse invalide');
				$is_erreur = true;
			}
		}

		$ville = $_POST['ville'] ?? null;
		if($code_postal) {
			if(strlen($ville) > 50) {
				Flash::ajouterErreur('ville', 'Adresse invalide');
				$is_erreur = true;
			}
		}

		$telephone = $_POST['telephone'] ?? null;
		if($telephone) {
			if(!preg_match('/^[0-9]{10}$/', $telephone)) {
				Flash::ajouterErreur('telephone', 'Telephone invalide (10 chiffres)');
				$is_erreur = true;
			}
		}

		if($is_erreur) {
			$this->redirect(null);
		}

		$bdd = DB::getInstance();
		$req = $bdd->prepare('update utilisateurs set nom=?, prenom=?, sexe=?, email=?, adresse=?, ville=?, code_postal=?, naissance=?, telephone=? where id=?');

		if($naissance == '') {
			$naissance = null;
		}


		$req->execute([
			//password_hash($mot_de_passe, PASSWORD_DEFAULT),

			$nom,
			$prenom,
			$sexe,
			$mail,
			$adresse,
			$ville,
			$code_postal,
			$naissance,
			$telephone,

			//where
			$connecte,
		]);

		$this->redirect(null, $this->SUCCES, 'Bravo les informations ont été changés !');
	}

}

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

		var_dump($pseudo, $mdp, $mdp2);
		$req = $bdd->prepare('INSERT INTO utilisateurs(pseudo, mdp) VALUES(?, ?)');
		$req->execute([$pseudo, $mdp]);

		$this->redirect('connexion', $this->SUCCES, 'Bravo ! L\'inscription à été réussie !');

		//$donnees = $pdo->query('SELECT * FROM utilisateurs')->fetchAll();
		//var_dump($donnees);
	}

}

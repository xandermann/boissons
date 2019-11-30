<?php

namespace App\Controllers;

use App\Controllers\Controller;

class UtilisateurController extends Controller {

	public function connexion() {
		$this->render('connexion');
	}

	public function inscription() {
		$this->render('inscription');
	}

}

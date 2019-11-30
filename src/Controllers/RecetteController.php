<?php

namespace App\Controllers;

use App\Controllers\Controller;

class RecetteController extends Controller {

	public function index() {
		return $this->render('recettesPreferees');
	}

	public function ajouter() {

	}

}

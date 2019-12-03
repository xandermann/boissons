<?php

namespace App\Controllers;

use App\Classes\Flash;

class Controller {

	protected $SUCCES = 'succes';
	protected $ERREUR = 'erreur';

	/**
	 * @param  string
	 * @param  array
	 * @return void
	 */
	protected function render(string $vue, array $variables = []): void {

		// Variables des vues ici
		$titre = 'Projet boisson';
		extract($variables);

		// On recupere le contenu
		ob_start();
		require("../src/Vues/pages/$vue.php");
		$content = ob_get_clean();

		// On rend le layout
		require('../src/Vues/app.php');
	}

	public function redirect($lien, string $status = null, string $message = null) {

		if (!is_null($status)) {
			Flash::creer($status, $message);
		}

		if($lien) {
			// Ajouter status et message
			header("Location: ?page=$lien");
		} else {
			header("Location: $_SERVER[HTTP_REFERER]");
		}
	}

}

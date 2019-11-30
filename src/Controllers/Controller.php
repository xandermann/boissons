<?php

namespace App\Controllers;

class Controller {

	protected $SUCCES = 0;
	protected $ERREUR = 1;

	/**
	 * @param  string
	 * @param  array
	 * @return void
	 */
	protected function render(string $vue, array $variables = []): void {

		// Variables des vues ici
		$title = 'Projet boisson';
		extract($variables);

		// On recupere le contenu
		ob_start();
		require("../src/Vues/pages/$vue.php");
		$content = ob_get_clean();

		// On rend le layout
		require('../src/Vues/app.php');
	}

	public function redirect(string $lien, int $status = null, string $message = null) {
		// Ajouter status et message
		header("Location: $lien");
	}

}

<?php

namespace App\Controllers;

class Controller {

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

}

<?php

namespace App\Classes;

class Flash {

	/**
	 * Creer un unique message flash (pour les redirections)
	 * @param  [type] $status  [description]
	 * @param  [type] $message [description]
	 * @return [type]          [description]
	 */
	public static function creer($status, $message) {
		$_SESSION['flash'][0]['age'] = 0;
		$_SESSION['flash'][0]['status'] = $status;
		$_SESSION['flash'][0]['message'] = $message;
	}

	public static function ajouterErreur($nom, $message) {
		$_SESSION['flash'][$nom]['age'] = 0;
		$_SESSION['flash'][$nom]['status'] = 'erreur';
		$_SESSION['flash'][$nom]['message'] = $message;
	}

	public static function incrementer() {
		// Pour les messages simples
		if (isset($_SESSION['flash']) && isset($_SESSION['flash']['age'])) {

			$_SESSION['flash']['age']++;

			if($_SESSION['flash']['age'] > 1) {
				unset($_SESSION['flash']);
			}
		}


		foreach($_SESSION['flash'] ?? [] as $message => $flash) {
			$_SESSION['flash'][$message]['age']++;

			if($_SESSION['flash'][$message]['age'] > 1) {
				unset($_SESSION['flash'][$message]);
			}
		}
	}

}

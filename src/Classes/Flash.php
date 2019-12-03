<?php

namespace App\Classes;

class Flash {

	public function creer($status, $message) {
		$_SESSION['flash']['age'] = 0;
		$_SESSION['flash']['status'] = $status;
		$_SESSION['flash']['message'] = $message;
	}

	public function incrementer() {
		if(isset($_SESSION['flash'])) {
			$_SESSION['flash']['age']++;
		}
	}

	public function supprimer() {
		if(isset($_SESSION['flash'])) {
			if($_SESSION['flash']['age'] == 2) {
				unset($_SESSION['flash']);
			}
		}
	}


}

<?php

namespace App\Classes;

class Flash {

	public static function creer($status, $message) {
		$_SESSION['flash']['age'] = 0;
		$_SESSION['flash']['status'] = $status;
		$_SESSION['flash']['message'] = $message;
	}

	public static function incrementer() {
		if(isset($_SESSION['flash'])) {
			$_SESSION['flash']['age']++;
		}
	}

	public static function supprimer() {
		if(isset($_SESSION['flash'])) {
			if($_SESSION['flash']['age'] == 1) {
				unset($_SESSION['flash']);
			}
		}
	}


}

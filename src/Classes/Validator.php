<?php

namespace App\Classes;

class Validator {

	public static const $CHAINE = 0;
	public static const $SEXE = 1;
	public static const $MOT_DE_PASSE = 2;

	public function __invoke($get, Validator $type) {
		$getATester = $_GET[$get];
		switch($type) {
			case self::CHAINE:
			// Test si chaine ici
			break;

			case self::SEXE:
				if($getATester != 'h' && $getATester != 'm') {
					Flash('Erreur');
				}
		}

		return $get;
	}

	public function getChaine($var) {
		// TODO faire valider
		Flash::creer('erreur', "Le formulaire '$var' n'est pas validé !");
		return $var;
	}

	public function getSexe($var) {
		if ($var != 'h' || $var != 'f') {
			Flash::creer('erreur', "Le formulaire '$var' est mal validé !");
		}
		return $var;
	}

	public function getMdp($var) {
		return $var;
	}

	public function getEmail($var) {
		return $var;
	}

	public function getDateNaissance($var) {
		return $var;
	}

	public function getCodePostal($var) {
		return $var;
	}

	public function getTelephone($var) {
		return $var;
	}

}

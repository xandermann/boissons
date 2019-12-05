<?php

namespace App\Classes;

use App\Classes\ValidatorException;

class Validator {

	const CHAINE = 0;
	const SEXE = 1;
	const MOT_DE_PASSE = 2;
	const TELEPHONE = 3;
	const CODE_POSTAL = 4;
	const EMAIL = 5;

	public static function valider(array $variables) {

		$ret = [];

		foreach($variables as $nom => $condition) {
			$variable = $_POST[$nom] ?? $_GET[$nom] ?? new ValidatorException('Variable inconnue');

			switch($condition) {
				case self::CHAINE: // Condition pour la chaine ici
				if(!is_string($variable)) {
					throw new ValidatorException($variable);
				}
				break;

				case self::SEXE:
				if($variable != 'h' || $variable != 'f') {
					throw new ValidatorException($variable);
				}
				break;

				case self::MOT_DE_PASSE:
				break;

				case self::TELEPHONE:
				break;

				case self::CODE_POSTAL:
				break;

				case self::EMAIL:
				break;

				default:
				throw new ValidatorException("$condition non valide !");
			}

			$ret[$nom] = $variable;
		}

		return $ret;
	}
}

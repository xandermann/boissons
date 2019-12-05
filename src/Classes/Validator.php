<?php

namespace App\Classes;

use App\Classes\ValidatorException;

class Validator {

	const CHAINE = 0;

	const CHAINE_NULLABLE = 7;
	const SEXE_NULLABLE = 1;
	const MOT_DE_PASSE = 2;
	const TELEPHONE_NULLABLE = 3;
	const CODE_POSTAL_NULLABLE = 4;
	const EMAIL_NULLABLE = 5;
	const DATE_NAISSANCE_NULLABLE = 6;

	public static function valider(array $variables) {

		$ret = [];

		foreach($variables as $nom => $condition) {
			$variable = $_POST[$nom] ?? $_GET[$nom] ?? new ValidatorException("Variable $nom inconnue");

			switch($condition) {
				case self::CHAINE:
				if(!is_string($variable)) {
					throw new ValidatorException($variable);
				}
				break;

				case self::CHAINE_NULLABLE:
				break;

				case self::SEXE_NULLABLE:
				if($variable != 'h' && $variable != 'f') {
					throw new ValidatorException("sexe $variable invalide");
				}
				break;

				case self::MOT_DE_PASSE:
				break;

				case self::TELEPHONE_NULLABLE:
				break;

				case self::CODE_POSTAL_NULLABLE:
				break;

				case self::EMAIL_NULLABLE:
				break;

				case self::DATE_NAISSANCE_NULLABLE:
				break;

				default:
				throw new ValidatorException("Constante condition non valide");
			}

			$ret[$nom] = $variable != '' ? $variable : null;
		}

		return $ret;
	}
}

<?php

namespace App\Classes;

use App\Classes\Flash;

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
			$variable = $_POST[$nom] ?? $_GET[$nom] ?? Flash::ajouterErreur($nom, 'Variable requise !');

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
				if(preg_match('/[a-zA-Z0-9]{4,}/',$variable)){
					throw new ValidatorException("le mot de passe doit contenir une majuscule, une minuscule et un numéro");
				}
				break;

				case self::TELEPHONE_NULLABLE:
				if(preg_match('/[0-9]{10}/',$variable)){
					throw new ValidatorException("le numero de telephone doit contenir 10 numéros et uniquement des numéros");
				}
				break;

				case self::CODE_POSTAL_NULLABLE:
				if(preg_match('/[0-9]{5}/',$variable)){
					throw new ValidatorException("le code postal doit contenir 5 numéros et uniquement des numéros");
				}
				break;

				case self::EMAIL_NULLABLE:
				if(preg_match('/[a-zA-Z0-9\.\-\_]+@[a-zA-Z0-9].[a-z]+/',$variable)){
					throw new ValidatorException("le mail doit contenir au moins un @ et une fin (.com, .fr...)");
				}
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

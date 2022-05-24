<?php

class Utilisateur {

	private $email;
	private $mdp;

	public function __construct(string $email, string $mdp) {
		$this->email = $email;
		$this->mdp = $mdp;
	}

	public static function insert() {
		/* Code pour inserer un utilisateur ici */
	}

}

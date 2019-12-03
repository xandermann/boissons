<?php

namespace App\Classes;

use \PDO;
use \Exception;

class DB {

  /**
   * @var Singleton
   * @access private
   * @static
   */
  private static $_instance = null;

   /**
    * Constructeur de la classe
    *
    * @param void
    * @return void
    */
   private function __construct() {
   }

   /**
    * Creer une instance de PDO
    * @return \PDO Instance de PDO
    */
   public static function getInstance() {

     if(is_null(self::$_instance)) {

      try {
       self::$_instance = new PDO("mysql:host=localhost;dbname=boissons;charset=utf8", 'root', 'root');
     } catch(Exception $e) {
      die($e->getMessage());
    }
  }

  return self::$_instance;
}
}


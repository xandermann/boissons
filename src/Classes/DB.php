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
        $config = parse_ini_file('../src/Config/config.ini');
        self::$_instance = new PDO("mysql:host=$config[host];dbname=$config[db];charset=utf8", $config['user'], $config['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      } catch(Exception $e) {
        die($e->getMessage());
      }
    }

    return self::$_instance;
  }
}


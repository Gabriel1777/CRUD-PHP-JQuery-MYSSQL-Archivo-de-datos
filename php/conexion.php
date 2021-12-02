<?php

class Conexion{

	protected $pdo;
	public static $user = "root";
	public static $password = "";
	public static $host = "localhost";
	public static $database = "prueba_tecnica";

	public function __construct(){
		$this->pdo = self::PDO();
	}

	public function PDO(){
	   $pdo = new PDO("mysql:host=" . self::$host . "; dbname=" . self::$database . ";" , self::$user , self::$password);
	   $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	   return $pdo;
	}

}

?>
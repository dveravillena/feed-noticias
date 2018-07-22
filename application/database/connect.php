<?php

class Database {
	private static $instance = NULL;

	private function __construct(){}

	private function __clone(){}

	//Función que realiza una conexión con la base de datos	
	public static function getConnect(){

		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'utf8'";
			self::$instance = new PDO('mysql:host=localhost;dbname=dailytrends','root','',$pdo_options);
		}
		return self::$instance;

	}

}
?>

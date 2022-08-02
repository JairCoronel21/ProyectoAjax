<?php


/**
	Creacion de la clase ConexionMysql
	Utilizando métodos y propiedas estaticos  
*/


// Clase PDO -> $cn = new PDO('mysql:host=localhost; ....') -> Instanciar la clase ->  Crear un objeto del tipo de la clase instanciado
// $cn->prepare(............) -> Aqui se utiliza el metodo prepare de la instancia 
// PDO::prepare -> Aqui se utiliza el metodo prepara de la clase PDO

// Metodos estáticos -> Se crea una clae que no necesita ser instanciada parta usar sus funcionaldiades (metdos estaticos)

class ConexionMysql
{

	static $Servidor = "localhost";
	static $Puerto = "3307";
	static $BaseDatos = "bdsistema";
	static $Usuario = "root";
	static $Password = "123456";

	
	function __construct()
	{

	}

	static function Conectarse(){

		try {
			
			$cn = new PDO("mysql:host=".self::$Servidor."; port=".self::$Puerto."; dbname=".self::$BaseDatos, self::$Usuario, self::$Password);
			return $cn;


		} catch (PDOException $e) {
			echo "Error en la conexion";
			return null;
		}

	}

}







?>
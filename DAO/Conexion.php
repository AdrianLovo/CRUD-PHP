<?php	
	
	/*
	* @author Adrian  
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	require_once("../Logs/LogError.php");
	require_once("../Logs/logWarning.php");

	class Conexion{

		//Atributos
		private $host = "localhost";	//host
		private $bd = "bdcrud";			//base de datos
		private $user = "bdcrud";		//usuario
		private $pass = "";				//pasword
		private $pdo;					//objeto conexion

		//Metodos
		public function conectar(){
			try{
				$cadena = "mysql:host=".$this->host.";dbname=".$this->bd;
				$this->pdo = new PDO($cadena, $this->user, $this->pass, array(PDO::ATTR_PERSISTENT => true));	
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $this->pdo;		
			}catch(Exception $e){
				LogError::guardarLog("Conexion.log", $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
			}			
		}

		public function desconectar(){
			$this->pdo = null;
		}

		public function __destruct(){
			$this->pdo = null;	
		}
		
	}

?>
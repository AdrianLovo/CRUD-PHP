<?php
	
	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	require_once("Conexion.php");	
	require_once("../Logs/LogError.php");
	require_once("../Logs/logWarning.php");

	abstract class Sql extends Conexion{

		abstract function queryListar();
		abstract function queryAgregar();
		abstract function queryEliminar();		
		abstract function queryModificar();
		abstract function queryBuscarPor($parametro, $filtro);

		abstract function metodoListar($resultSet);
		abstract function metodoAgregar($statement, $parametro);
		abstract function metodoEliminar($statement, $parametro);				
		abstract function metodoModificar($statement, $parametro);
		abstract function metodoBuscarPor($resultSet);

		/*
		* Metodo para listar todos los elementos de tabla "persona"
 		* @access: public
 		* @return: array() de objetos "Persona" 
 		*/
		public function listar() {
			$arrayDeObjetos = array();
			$pdo = $this->conectar();
			try {
				$resultSet = $pdo->query($this->queryListar());
				$arrayDeObjetos = $this->metodoListar($resultSet);
				$this->desconectar();
				return $arrayDeObjetos;
			} catch (Exception $e) {
				LogErro::guardarLog("Sql.log", $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
			}finally{
				$this->desconectar();
			}
		}		


		/*
		* Metodo para agregar 1 registro a la tabla "persona"
		* @access: public
		* @param:  $parametro (Objeto de la clase Persona)		
 		* @return: $filasAfectadas (int de registros agregados)
 		*/
		public function agregar($parametro){
			$pdo = $this->conectar();
			try{
				$statement = $pdo->prepare($this->queryAgregar());
				$filasAfectadas = $this->metodoAgregar($statement, $parametro);		
				return $filasAfectadas;
			}catch(PDOException $e){
				$pdo->rollBack();
				LogError::guardarLog("Sql.log", $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
			}finally{
				$this->desconectar();
			}
		}


		/*
		* Metodo para eliminar registrosa de la tabla "persona" segun "id"
		* @access: public
		* @param:  $parametro (int indicando identificado)		
 		* @return: $filasAfectadas (int de registros eliminados)
 		*/
		public function eliminar($parametro) {
			$pdo = $this->conectar();
			try{
				$statement = $pdo->prepare($this->queryEliminar());
				$filasAfectadas = $this->metodoEliminar($statement, $parametro);
				return $filasAfectadas;
			}catch(Exception $e){
				LogError::guardarLog("Sql.log", $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
			}finally{
				$this->desconectar();
			}
		}


		/*
		* Metodo para modificar registrosa de la tabla "persona" segun "id"
		* @access: public
		* @param:  $parametro (Objeto de la clase Persona)		
 		* @return: $filasAfectadas (int de registros modificados)
 		*/
		public function modificar($parametro){
			$pdo = $this->conectar();
			try{
				$statement = $pdo->prepare($this->queryModificar());
				$filasAfectadas = $this->metodoModificar($statement, $parametro);
				return $filasAfectadas;
			}catch(Exception $e){
				LogError::guardarLog("Sql.log", $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
			}finally{
				$this->desconectar();
			}
		}


		/*
		* Metodo para listar todos segun el filtro indicado
 		* @access: public
 		* @return: array() de objetos "Persona" 
 		*/
		public function buscar($parametro, $filtro) {
			$arrayDeObjetos = array();
			$pdo = $this->conectar();
			try {
				$resultSet = $pdo->query($this->queryBuscarPor($parametro, $filtro));
				$arrayDeObjetos = $this->metodoBuscarPor($resultSet);
				$this->desconectar();
				return $arrayDeObjetos;
			} catch (Exception $e) {
				echo($e);
				LogErro::guardarLog("Sql.log", $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
			}finally{
				$this->desconectar();
			}
		}
		

	}





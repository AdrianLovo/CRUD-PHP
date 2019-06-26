<?php

	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	require_once("Sql.php");
	require_once("../Entidades/Persona.php");

	class DAOPersona extends Sql{
	
		public function queryListar(){
			$query = "SELECT * FROM bdcrud.persona";
			return $query;
		}

		public function metodoListar($resultSet){
			$arrayDeObjetos = array();
			if(!empty($resultSet)){
				foreach($resultSet as $fila){
					$a = new Persona(
							$fila["idPersona"], 
							$fila["nombre"], 
							$fila["apellido"], 
							$fila["edad"], 
							$fila["genero"], 
							$fila["fechaNac"], 
							$fila["imagen"]
						);
					array_push($arrayDeObjetos, $a);
				}	
			}	
			return $arrayDeObjetos;
		}

		public function queryAgregar(){
			$query = "INSERT INTO bdcrud.persona (nombre, apellido, edad, genero, fechaNac, imagen) VALUES(?, ?, ?, ?, ?, ?)";			
			return $query;
		}

		public function metodoAgregar($statement, $parametro){
			$statement->execute([
					$parametro->getNombre(), 
					$parametro->getApellido() , 
					$parametro->getEdad(), 
					$parametro->getGenero(), 
					$parametro->getFechaNac(), 
					$parametro->getImagen() 
				]);
			$filasAfectadas = $statement->rowCount();
			return $filasAfectadas;
		}

		public function queryEliminar(){
			$query = "DELETE FROM bdcrud.persona WHERE idPersona = ?";
			return $query;
		}

		public function metodoEliminar($statement, $parametro){
			$statement->execute([$parametro]);
			$filasAfectadas = $statement->rowCount();
			return $filasAfectadas;
		}

		public function queryModificar(){
			$query = "UPDATE bdcrud.persona SET nombre=?, apellido=?, edad=?, genero=?, fechaNac=?, imagen=? WHERE idPersona=?";
			return $query;
		}

		public function metodoModificar($statement, $parametro){
			$statement->execute([
					$parametro->getNombre(), 
					$parametro->getApellido(), 
					$parametro->getEdad(), 
					$parametro->getGenero(), 
					$parametro->getFechaNac(),
					$parametro->getImagen(),
					$parametro->getIdPersona(),
				]);
			$filasAfectadas = $statement->rowCount();
			return $filasAfectadas;
		}

		public function queryBuscarPor($parametro, $filtro){
			$valor = $parametro->getValor($filtro);
			$tipo = $parametro->getTipo($filtro);
			if($tipo == 1){
				return $query = "SELECT * FROM bdcrud.persona WHERE $filtro = $valor";
			}else{
				return $query = "SELECT * FROM bdcrud.persona WHERE $filtro = '$valor'";
			}
		}

		public function metodoBuscarPor($resultSet){
			$arrayDeObjetos = array();
			if(!empty($resultSet)){
				foreach($resultSet as $fila){
					$a = new Persona(
							$fila["idPersona"], 
							$fila["nombre"], 
							$fila["apellido"], 
							$fila["edad"], 
							$fila["genero"], 
							$fila["fechaNac"], 
							$fila["imagen"]
						);
					array_push($arrayDeObjetos, $a);
				}	
			}
			return $arrayDeObjetos;
		}

				
	}


?>
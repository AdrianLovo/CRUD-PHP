<?php

	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	require_once("../DAO/DAOPersona.php");
	require_once("../Modelos/Persona.php");

	//Validar Existencia de variables POST
	$Funcion = isset($_POST['Funcion']) ? $_POST['Funcion'] : null;
	$idPersona = isset($_POST['idPersona']) ? $_POST['idPersona'] : null;
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
	$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
	$edad = isset($_POST['edad']) ? $_POST['edad'] : null;
	$genero = isset($_POST['genero']) ? $_POST['genero'] : null;
	$fechaNac = isset($_POST['fechaNac']) ? $_POST['fechaNac'] : null;

	switch ($Funcion) {
		case 1: Listar();
			break;	
		case 2: Eliminar($idPersona);
			break;	
		case 3: $persona = new Persona($idPersona, $nombre, $apellido, $edad, $genero, $fechaNac, '...');
				Modificar($persona);		
			break;
	}

	//Listar
	function Listar(){
		$datosTodos = array();
		$daoPersona = new DAOPersona();

		foreach ($daoPersona->listar() as $persona) {
			$temp = $persona->toArray();
			$datos = array(
				'idPersona' => $temp[0],
            	'nombre' 	=> $temp[1],
            	'apellido' 	=> $temp[2],
            	'edad' 		=> $temp[3],
            	'genero' 	=> $temp[4],
            	'fechaNac' 	=> $temp[5],
            	'imagen' 	=> $temp[6]
			);
			$datosTodos[] = $datos;	
		}
		echo json_encode($datosTodos);	
	}
	
	//Eliminar
	function Eliminar($idPersona){
		$daoPersona = new DAOPersona();
		echo($daoPersona->eliminar($idPersona));
	}

	//Modificar
	function Modificar($persona){
		$daoPersona = new DAOPersona();
		echo($daoPersona->modificar($persona));
	}









?>
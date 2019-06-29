<?php

	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	require_once("../DAO/DAOPersona.php");
	require_once("../Modelos/Persona.php");

	$Funcion = $_POST['Funcion'];

	switch ($Funcion) {
		case 1: listar();
			break;		
	}

	//Listar
	function listar(){
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
	











?>
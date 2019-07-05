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
		case 2: $persona = new Persona(null, $nombre, $apellido, $edad, $genero, $fechaNac, "");
				Agregar($persona);
			break;	
		case 3: Eliminar($idPersona);
			break;	
		case 4: $persona = new Persona($idPersona, $nombre, $apellido, $edad, $genero, $fechaNac, '...');
				Modificar($persona);		
			break;
	}


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

	function Agregar($persona){
		$ruta = ProcesarImagen();
		if($ruta != ""){			
			$persona->setImagen($ruta);
			$daoPersona = new DAOPersona();
			$idGenerado = $daoPersona->agregar($persona);	
			$datos = array('IdGenerado' => $idGenerado, 'Imagen' => $ruta);
		}else{
			$datos = array('IdGenerado' => '', 'Ruta' => '');
		}
		echo json_encode($datos);
	}
	
	function Eliminar($idPersona){
		$daoPersona = new DAOPersona();
		echo ($daoPersona->eliminar($idPersona));
	}

	function Modificar($persona){
		$daoPersona = new DAOPersona();
		echo($daoPersona->modificar($persona));
	}

	function ProcesarImagen(){
		$proceso = false;
		$ruta = "";

		if(!empty($_FILES['file']['name'])){
    		$uploadedFile = '';
    
		    if(!empty($_FILES["file"]["type"])){
		        $fileName = time().'_'.$_FILES['file']['name'];
		        $valid_extensions = array("jpeg", "jpg", "png");
		        $temporary = explode(".", $_FILES["file"]["name"]);
		        $file_extension = end($temporary);
		        
		        if((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
		            $sourcePath = $_FILES['file']['tmp_name'];
		            $targetPath = "../Resources/".$fileName;
		            
		            if(move_uploaded_file($sourcePath,$targetPath)){
		                $uploadedFile = $fileName;
		                $proceso = true;
		                $ruta = $targetPath;
		            }
		        }
		    }    	    
		}

		if($proceso == true){
			return $ruta;
		}else{
			return "";
		}
	}

?>
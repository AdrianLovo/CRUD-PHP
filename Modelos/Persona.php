<?php

	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	class Persona{

		//Atributos
		private $idPersona;
		private $nombre;
		private $apellido;
		private $edad;
		private $genero;
		private $fechaNac;
		private $imagen;

		//Constructor
		public function __construct($idPersona, $nombre, $apellido, $edad, $genero, $fechaNac, $imagen){
			$this->idPersona = $idPersona;
			$this->nombre = $nombre;
			$this->apellido = $apellido;
			$this->edad = $edad;
			$this->genero = $genero;
			$this->fechaNac = $fechaNac;
			$this->imagen = $imagen;
		}

		
		//Metodos Get y Set
		public function getIdPersona(){
		    return $this->idPersona;
		}
		
		public function setIdPersona($idPersona){
		    $this->idPersona = $idPersona;
		}

		public function getNombre(){
		    return $this->nombre;
		}
		
		public function setNombre($nombre){
		    $this->nombre = $nombre;
		}

		public function getApellido(){
		    return $this->apellido;
		}
		
		public function setApellido($apellido){
		    $this->apellido = $apellido;
		}

		public function getEdad(){
		    return $this->edad;
		}
		
		public function setEdad($edad){
		    $this->edad = $edad;
		}

		public function getGenero(){
		    return $this->genero;
		}
		
		public function setGenero($genero){
		    $this->genero = $genero;
		}

		public function getFechaNac(){
		    return $this->fechaNac;
		}
		
		public function setFechaNac($fechaNac){
		    $this->fechaNac = $fechaNac;
		}

		public function getImagen(){
		    return $this->imagen;
		}
		
		public function setImagen($imagen){
		    $this->imagen = $imagen;
		}

		//Metodo toString para mostrar campos de objeto
		public function toString(){
			echo(
				"idPersona: " . $this->idPersona.
				"nombre: " . $this->nombre.
				"apellido: " . $this->apellido.
				"edad: " . $this->edad.
				"genero: " . $this->genero.
				"fechaNac: " . $this->fechaNac.
				"imagen: " . $this->imagen
			);
		}

		//Metodo para obtener los datos de los atributos en un array
		public function toArray(){
			$datos = array($this->idPersona, $this->nombre, $this->apellido, $this->edad, $this->genero, $this->fechaNac,$this->imagen);
			return $datos;
		}

		//Obtiene el valor segun el filtro
		public function getValor($filtro){
			switch ($filtro) {
				case 'idPersona':
					return $this->idPersona;
					break;		
				case 'nombre':
					return $this->nombre;
					break;	
				case 'apellido':
					return $this->apellido;
					break;			
				case 'edad':
					return $this->edad;
					break;	
				case 'genero':
					return $this->genero;
					break;	
				case 'fechaNac':
					return $this->fechaNac;
					break;	
				case 'imagen':
					return $this->imagen;
					break;	
				default:
					return "";
					break;
			}
		}

		/*Obtiene el tipo segun el filtro
			Entero = 1
			cadena = 2
		*/
		public function getTipo($filtro){
			switch ($filtro) {
				case 'idPersona':
					return 1;
					break;		
				case 'nombre':
					return 2;
					break;	
				case 'apellido':
					return 2;
					break;			
				case 'edad':
					return 1;
					break;	
				case 'genero':
					return 2;
					break;	
				case 'fechaNac':
					return 2;
					break;	
				case 'imagen':
					return 2;
					break;	
				default:
					return 2;
					break;
			}
		}

	}


?>
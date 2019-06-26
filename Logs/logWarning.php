<?php
	
	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/

	require_once("LogError.php");
	
	set_error_handler("logWarning", E_WARNING);
			
	function logWarning($errno, $errstr, $errfile, $errline) { 
		$nombres = explode("\\", $errfile);
		$nombreArchivo = $nombres[sizeof($nombres)-1];
		$nombreArchivo = str_replace(".php", ".log", $nombreArchivo);
		LogError::guardarLog($nombreArchivo, $errstr, "Mensaje Warning", $errfile, $errline);
	}

?>
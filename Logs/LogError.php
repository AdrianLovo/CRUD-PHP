<?php

	/*
	* @author Adrian 
	* https://github.com/AdrianLovo/CRUD-PHP
	*/
	
	class LogError{

		public static function guardarLog($nombreArchivoLog, $mensaje, $codigo, $archivo, $linea){
			$ddf = fopen($nombreArchivoLog,"a");
			fwrite($ddf, "-------------------------------------------------------------------------\r\n");
			fwrite($ddf, "Fecha:   " . date('l jS \of F Y h:i:s A'). "\r\n");
			fwrite($ddf, "Mensaje: " . $mensaje . "\r\n");
			fwrite($ddf, "Codigo:  " . $codigo . "\r\n");
			fwrite($ddf, "Archivo: " . $archivo . "\r\n");
			fwrite($ddf, "Linea:   " . $linea . "\r\n\r\n");
			fclose($ddf);
		}	

	}




?>
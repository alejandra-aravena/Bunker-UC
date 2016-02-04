<?php

class DescargasZip {
	public static function listarArchivosDirectorio($dir) {
    	$result = array();
    	$root = scandir($dir);
    	foreach($root as $value) {
      		if($value === '.' || $value === '..') {
        		continue;
      		}
      		if(is_file("$dir$value")) {
        		$result[] = "$dir$value";
        		continue;
      		}
      		if(is_dir("$dir$value")) {
        		$result[] = "$dir$value/";
      		}
      		foreach(self::listarArchivosDirectorio("$dir$value/") as $value) {
        		$result[] = $value;
      		}
    	}
    	return $result;
	}
	
	public static function listarArchivosXEstacionEnDirectorio($dir, $ano, $mes, $dia, $estacion) {
		
		if ($dia == '00') {
			$cadena = "OUT-$ano$mes*-*-$estacion-*.*";
		} else {
			$cadena = "OUT-$ano$mes$dia-*-$estacion-*.*";
		}
		
    	$result = array();
    	$root = scandir($dir);
    	foreach($root as $value) {
      		if($value === '.' || $value === '..') {
        		continue;
      		}
      		if(is_file("$dir$value")) {
				$nombre = pathinfo("$dir$value", PATHINFO_FILENAME);
				if (fnmatch($cadena, $nombre)) {
					$result[] = "$dir$value";
				}
        		continue;
      		}
      		if(is_dir("$dir$value")) {
        		$result[] = "$dir$value/";
      		}
      		foreach(self::listarArchivosXEstacionEnDirectorio("$dir$value/", $ano, $mes, $dia, $estacion) as $value) {
	        		$result[] = $value;
      		}
    	}
    	return $result;
	}
	
	public static function listarArchivosXTelefonoEnDirectorio($dir, $ano, $mes, $dia, $telefono) {
		if ($dia == '00') {
			$cadena = "OUT-$ano$mes*-*-*-$telefono-*.*";
		} else {
			$cadena = "OUT-$ano$mes$dia-*-*-$telefono-*.*";
		}
		
    	$result = array();
    	$root = scandir($dir);
    	foreach($root as $value) {
      		if($value === '.' || $value === '..') {
        		continue;
      		}
      		if(is_file("$dir$value")) {
				if (fnmatch($cadena, $nombre)) {
	        		$result[] = "$dir$value";
				}
	    		continue;
      		}
      		if(is_dir("$dir$value")) {
        		$result[] = "$dir$value/";
      		}
      		foreach(self::listarArchivosXTelefonoEnDirectorio("$dir$value/", $ano, $mes, $dia, $estacion) as $value) {
        			$result[] = $value;
      		}
    	}
    	return $result;
	}
	
	public static function listarArchivosZip($dir) {
		
		$dh  = opendir($dir);
		
		while (false !== ($filename = readdir($dh))) {
			if (($filename != '..') && ($filename != '.')) {
				if (fnmatch('*.zip', $filename)) {
	        		$files[]= $filename;
				}
			}
		}
		return $files;
	}
	
}

?>
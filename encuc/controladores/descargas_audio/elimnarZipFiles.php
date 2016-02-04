<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
 
require_once("../../modelo/descarga_zip.php");
require_once("../../config/config.php");

$zip_dir = FOLDER_UPLOADS;

$file_list = DescargasZip::listarArchivosZip($zip_dir);
 
$correctas = 0;
$incorrectas = 0; 

if (is_array($file_list)) {
	foreach ($file_list as $file) {
	  if(unlink(FOLDER_UPLOADS.$file))
		$correctas++;
	  else
		$incorrectas++;
	}
	
	$resultado = array(
					'correctas' 		=> $correctas,
					'incorrectas' 		=> $incorrectas
				);
	echo json_encode($resultado);
}
else 
	echo "NADA";

?>
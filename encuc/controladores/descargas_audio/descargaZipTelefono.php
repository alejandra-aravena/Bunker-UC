<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
 
require_once("../../modelo/descarga_zip.php");
require_once("../../config/config.php");

$dia = ($_POST['dia'] != '' ? $_POST['dia'] : '00');
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$telefono = $_POST['telefono'];

if ($dia == '00') {
	$source_dir = FOLDER_CDR.$ano.$mes.'/';
} else {
	$source_dir = FOLDER_CDR.$ano.$mes.'/'.$dia.'/';
}

$zip_file = FOLDER_UPLOADS.$ano.'_'.$mes.'_'.$dia.'_'.$telefono.'.zip';
if(file_exists($zip_file)) unlink($zip_file);

$file_list = DescargasZip::listarArchivosXEstacionEnDirectorio($source_dir, $ano, $mes, $dia, $telefono);
 
$zip = new ZipArchive();
if ($zip->open($zip_file, ZIPARCHIVE::CREATE) === true) {
  foreach ($file_list as $file) {
    if ($file !== $zip_file) {
      $zip->addFile($file, substr($file, strlen($source_dir)));
    }
  }
  $zip->close();
}

echo $zip_file;

?>
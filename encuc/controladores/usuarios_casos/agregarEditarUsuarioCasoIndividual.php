<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios_casos.class.php");

$idUsuario=$_POST["idUsuario"];
$idCaso=$_POST["idCaso"];

$uCasos = new UsusariosCasos();

$search = $uCasos->getByIdCaso($idCaso);

if (count($search) == 0) {
	$addEC = $uCasos->add_usuario_caso($idCaso, $idUsuario);
	if ($addEC) 
		echo "ok";
	else
		echo "error";
}
else {
	$updtEC = $uCasos->edit_usuario_caso($idCaso, $idUsuario);
	if ($updtEC) 
		echo "ok";
	else
		echo "error";
}
	
?>
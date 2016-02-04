<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios_casos.class.php");

$idUsuario = $_POST['idUsuario'];

$uCasos = new UsusariosCasos();

$arrayUCasos = $uCasos->getAllUsuarioCasosByIdUsuario($idUsuario);

echo json_encode ($arrayUCasos);

?>
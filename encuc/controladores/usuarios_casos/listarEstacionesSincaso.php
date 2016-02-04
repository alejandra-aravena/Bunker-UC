<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios_casos.class.php");

$uCasos = new UsusariosCasos();

$arrayUCasos = $uCasos->getAllUsuarioSinCasoso();

echo json_encode ($arrayUCasos);

?>
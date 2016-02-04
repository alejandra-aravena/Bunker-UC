<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios.class.php");

$usuarios = new Usuarios();

$arrayEstaciones = $usuarios->get_allEstaciones();

echo json_encode ($arrayEstaciones);

?>
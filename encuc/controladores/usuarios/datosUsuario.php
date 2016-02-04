<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios.class.php");

$idUsuario=$_POST["usuario_id"];

$usuarios = new Usuarios();

$getUsuario = $usuarios->get_usuarioById($idUsuario);

if ($getUsuario) {
	echo json_encode($getUsuario);
}
else
	echo "error";

?>
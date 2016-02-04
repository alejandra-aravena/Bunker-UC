<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios.class.php");

$id_usuario=$_POST["id_usuario"];

$usuarios = new Usuarios();

$delUsuario = $usuarios->del_usuarioById($id_usuario);

if ($delUsuario) {
	echo "ok";
}
else
	echo "error";

?>
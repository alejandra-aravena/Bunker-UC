<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios.class.php");

$id_usuario=$_POST["id_usuario"];
$password = md5($_POST["password"]);

$usuarios = new Usuarios();

$editUsuario = $usuarios->cambiarPassword($id_usuario, $password);

if ($editUsuario) {
	echo "ok";
}
else
	echo "error";
?>
<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios.class.php");

$usuario=$_POST["usuario"];
$id_usuario=$_POST["id_usuario"];
$ipEstacion=$_POST["ipEstacion"];
$numCdr=$_POST["numCdr"];

$usuarios = new Usuarios();

$editUsuario = $usuarios->edit_usuario($id_usuario, $usuario, $ipEstacion, $numCdr); 

if ($editUsuario) {
	echo "ok";
}
else
	echo "error";

?>
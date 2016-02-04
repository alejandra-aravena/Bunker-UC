<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles_usuarios.class.php");

$id_usuario=$_POST["id_usuario"];
$id_rol=$_POST["id_rol"];

$rolUsuarios = new RolesUsuarios();

$delRolUsuario = $rolUsuarios->del_RolUsuarioByIds($id_usuario, $id_rol);

if ($delRolUsuario) {
	echo "ok";
}
else
	echo "error";

?>
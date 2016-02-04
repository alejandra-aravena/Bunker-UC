<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles_usuarios.class.php");

$rolesArray = json_decode(stripslashes($_POST['roles']));
$id_usr = $_POST["id_usr"];

$rolesUsuario = new RolesUsuarios();

$todoOK = 'ok';
foreach ($rolesArray AS $id_rol) {
	$addRolUsuario = $rolesUsuario->add_rol_usuario($id_usr,$id_rol);
	if ($addRolUsuario) {
	}else
		$todoOK = 'error';
}

echo $todoOK;
?>
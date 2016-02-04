<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles_usuarios.class.php");

$rolesUsuarios = new RolesUsuarios();

$arrayRolesUsuarios = $rolesUsuarios->get_allRolesUsuarios();

echo json_encode ($arrayRolesUsuarios);

?>
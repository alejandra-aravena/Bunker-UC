<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles.class.php");

$rol=$_POST["rol"];
$id_rol=$_POST["id_rol"];

$roles = new Roles();

$editRol = $roles->edit_rol($id_rol, $rol);

if ($editRol) {
	echo "ok";
}
else
	echo "error";

?>
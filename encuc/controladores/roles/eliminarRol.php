<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles.class.php");

$id_rol=$_POST["id_rol"];

$roles = new Roles();

$delRol = $roles->del_rolById($id_rol);

if ($delRol) {
	echo "ok";
}
else
	echo "error";

?>
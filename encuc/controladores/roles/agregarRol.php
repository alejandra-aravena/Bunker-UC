<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles.class.php");

$rol=$_POST["rol"];

$roles = new Roles();

$addRol = $roles->add_rol($rol);

if ($addRol) {
	echo "ok";
}
else
	echo "error";

?>
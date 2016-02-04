<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles.class.php");

$idRol=$_POST["rol_id"];

$roles = new Roles();

$getRol = $roles->get_rolById($idRol);

if ($getRol) {
	echo json_encode($getRol);
}
else
	echo "error";

?>
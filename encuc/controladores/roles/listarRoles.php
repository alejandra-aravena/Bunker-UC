<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/roles.class.php");

$roles = new Roles();

$arrayRoles = $roles->get_allRoles();

echo json_encode ($arrayRoles);

?>
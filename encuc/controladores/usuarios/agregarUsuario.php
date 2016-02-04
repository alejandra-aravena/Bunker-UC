<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios.class.php");

$usuario = $_POST["usuario"];
$password = md5($_POST["password"]);
$ipEstacion=$_POST["ipEstacion"];
$numCdr=$_POST["numCdr"];

$usuarios = new Usuarios();

$addUsuario = $usuarios->add_usuario($usuario, $password, $ipEstacion, $numCdr);

if ($addUsuario) {
	echo "ok";
}
else
	echo "error";

?>
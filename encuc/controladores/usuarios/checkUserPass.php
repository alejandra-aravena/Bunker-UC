<?php
session_start();
/* Validar username y password en la base de datos */
require_once("../../modelo/usuarios.class.php");

$username=$_POST["username"];
$password=md5($_POST["password"]);

$usuarios = new Usuarios();

$datosUsr = $usuarios->datosUsuario($username);

if ($datosUsr) {
		
		if (($datosUsr->usrname == $username) && ($datosUsr->password == $password)) {
			
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$_SESSION['idUsr'] = $datosUsr->id_usuario;
			
			$adEs = $usuarios->get_EstacionByIdUsuer($datosUsr->id_usuario);
			
			if ($adEs->num_rows == 0) {
				$_SESSION['estacion']= false;
				$_SESSION['admin']= true;
				$_SESSION['roles'] = $usuarios->get_RolesByIdUsuer($datosUsr->id_usuario);
	
			} else {
				$_SESSION['estacion']= true;
				$_SESSION['admin']= false;
				$_SESSION['roles']= array(7);
			}
			
			if(isset($_POST['remember'])){
				setcookie("encuestasUC", $_SESSION['username'], time()+60*60*24*100, "/");
				setcookie("encuestasUCpass", $_SESSION['password'], time()+60*60*24*100, "/");
				setcookie("estacionUCEN", $_SESSION['estacion'], time()+60*60*24*100, "/");
				setcookie("adminUCEN", $_SESSION['admin'], time()+60*60*24*100, "/");
				setcookie("idUsrUCEN", $_SESSION['idUsr'], time()+60*60*24*100, "/");
				setcookie("rolesUCEN", $_SESSION['roles'], time()+60*60*24*100, "/");
			}
			
			if ($_SESSION['admin']) {
				echo "admin";
			} else {
				echo "estacion";
			}
	}
	else 
		echo "error";
}
else
	echo "usr";
?>
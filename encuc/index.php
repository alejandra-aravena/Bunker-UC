<?php session_start();
if(isset($_COOKIE['encuestasUC']) && isset($_COOKIE['encuestasUCpass'])){
	$_SESSION['username'] = $_COOKIE['encuestasUC'];
	$_SESSION['password'] = $_COOKIE['encuestasUCpass'];
	
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];
	
	require_once("../modelo/usuarios.class.php");
	
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
				header('Location: vistas/home.php');
			} else {
				header('Location: vistas/estacion/estacion/verEstacion.php');
			}
			
			
		}
		else 
			header('Location: vistas/ingreso/login.php');
	}
	else
		header('Location: vistas/ingreso/login.php');
}
else
	header('Location: vistas/ingreso/login.php');
?>

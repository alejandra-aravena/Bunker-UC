<?php
session_start();
session_destroy();

if(isset($_COOKIE['encuestasUC']) && isset($_COOKIE['encuestasUCpass'])){	
	setcookie("encuestasUC", "", time()-60*60*24*100, "/");
	setcookie("encuestasUCpass", "", time()-60*60*24*100, "/");
	setcookie("estacionUCEN", "", time()-60*60*24*100, "/");
	setcookie("adminUCEN", "", time()-60*60*24*100, "/");
	setcookie("idUsrUCEN", "", time()-60*60*24*100, "/");
	setcookie("rolesUCEN", "", time()-60*60*24*100, "/");
}

header ("Location: ../../index.php");
?>
<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios_casos.class.php");

$idUsuario = $_POST["idUsuario"];
$idCasoInicial = (int) $_POST["idCasoInicial"];
$idCasoFinal = (int) $_POST["idCasoFinal"];

$uCasos = new UsusariosCasos();

$agregadas = 0;
$editadas = 0;
$errores = 0;
for ($idCaso = $idCasoInicial; $idCaso <= $idCasoFinal; $idCaso++):

	$search = $uCasos->getByIdCaso($idCaso);
	
	if (count($search) == 0) {
		$addEC = $uCasos->add_usuario_caso($idCaso, $idUsuario);
		if ($addEC) 
			$agregadas++;
		else
			$errores++;
	}
	else {
		$updtEC = $uCasos->edit_usuario_caso($idCaso, $idUsuario);
		if ($updtEC) 
			$editadas++;
		else
			$errores++;
	}
	
endfor;	

$resultado = array(
				'agregadas' => $agregadas,
				'editadas' 	=> $editadas,
				'errores'	=> $errores
			);
echo json_encode($resultado);
?>
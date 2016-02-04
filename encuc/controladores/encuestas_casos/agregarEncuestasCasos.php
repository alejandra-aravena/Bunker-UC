<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas_casos.class.php");

$idEncuesta=$_POST["idEncuesta"];
$idCasoInicial = (int) $_POST["idCasoInicial"];
$idCasoFinal = (int) $_POST["idCasoFinal"];

$EncuestasCasos = new EncuestasCasos();

$agregadas = 0;
$editadas = 0;
$errores = 0;
for ($idCaso = $idCasoInicial; $idCaso <= $idCasoFinal; $idCaso++):

	if (!$EncuestasCasos->getEncuestaByCaso($idCaso)) {
		$addEC = $EncuestasCasos->add_encuesta_caso($idCaso, $idEncuesta);
		if ($addEC) {
			$agregadas++;
		}
		else
			$errores++;
			
	} else {
		$editEC = $EncuestasCasos->edit_encuesta_caso($idCaso, $idEncuesta);
		if ($editEC) {
			$editadas++;
		}
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
<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_visibilidad.class.php");

$Columnas = new ColumnasVisibilidad();

$arrayColumnas = $Columnas->get_columnasBase();

$correctas = 0;
$incorrectas = 0;
$filasIncorrectas = array();

foreach ($arrayColumnas AS $key=>$row) {
	if ($row->Field == 'id_caso') {
		$addVC = $Columnas->add_visibilidadColumna($row->Field, 1);
	}
	else if ($row->Field == 'telefono') {
		$addVC = $Columnas->add_visibilidadColumna($row->Field, 1);
	}
	else {
		$addVC = $Columnas->add_visibilidadColumna($row->Field, 0);
	}
	
	if ($addVC) {
		$correctas++;
	} else {
		$incorrectas++;
		$filasIncorrectas[] = $row->Field;
	}
}

$resultado = array(
				'correctas' 		=> $correctas,
				'incorrectas' 		=> $incorrectas,
				'filasIncorrectas'	=> $filasIncorrectas
			);
echo json_encode($resultado);

?>
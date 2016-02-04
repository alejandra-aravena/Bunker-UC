<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/usuarios_casos.class.php");

$idUsuario = $_POST['idUsuario'];

$uCasos = new UsusariosCasos();

$arrayUCasos = $uCasos->getIdUsuarioCasosNORMALWhitJoins($idUsuario);

function cmp($a, $b)
{
    if ($a->prioridad == $b->prioridad) {
        return 0;
    }
    return ($a->prioridad < $b->prioridad) ? 1 : -1;
}

$idAccion = 0;

$caso = array();
if (count($arrayUCasos) > 0) {
	$ci1 = '0';
	
	
	foreach ($arrayUCasos AS $key=>$row) {
		$d2 = new DateTime($row->update_date);
		$ci2 = $row->CASO;
		
		if ($ci1 == $ci2) {
			
			if ($d2 > $d1) {
				$caso[$ci2]=$row;
			}
			
		} else {
			$caso[$ci2]=$row;
			$d1 = new DateTime('0000-00-00 00:00:00');
		}
		
		$ci1 = $ci2;
		$d1 = $d2;
	
	}
	
	
	usort($caso, "cmp");
	
$res = array();
	
foreach ($caso AS $k=>$c) {
	if (($c->id_accion != 2) && ($c->prioridad != 0)) {
		$res[] = $c;
	}
}
		
	$respuesta = array_chunk($res, 3, true);
	
	echo json_encode ($respuesta[0]);
}
else
	echo "NADA";

?>
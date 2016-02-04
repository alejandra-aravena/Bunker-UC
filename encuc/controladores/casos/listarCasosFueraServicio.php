<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/casos.class.php");

$casos = new Casos();

$arrayCasos = $casos->getAllCasosFueraServicio();

$caso = array();
$i=0;
$hoy = new DateTime('now');
if (count($arrayCasos) > 0) {
	$ci1 = '0';
	
	
	foreach ($arrayCasos AS $key=>$row) {
		$d2 = new DateTime($row->update_date);
		$ci2 = $row->id_caso;
		
		if ($ci1 == $ci2) {
			
			if ($d2 > $d1) {
				$caso[$i]=$row;
			}
			
		} else {
			$caso[$i]=$row;
	
			$d1 = new DateTime('0000-00-00 00:00:00');
			$i++;
		}
		
		$ci1 = $ci2;
		$d1 = $d2;
	
	}
}


echo json_encode ($caso);

?>
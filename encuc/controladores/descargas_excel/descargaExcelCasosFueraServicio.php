<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
//Nombre de Proyecto
require_once("../../modelo/generales.class.php");
$generales = new Generales();
$getGeneral = $generales->get_generalByName('Nombre Proyecto'); 
$nombreProyecto = $getGeneral->valor;
$nombreProyecto = str_replace(" ","_", $nombreProyecto);
$nombreProyecto = str_replace(".","_", $nombreProyecto);

//Folder para guardar
require_once("../../config/config.php");

//Fecha de ahora
$timeStamp = new DateTime();
$fecha =  $timeStamp->format('d-m-Y');
$hora =  $timeStamp->format('H:i');

//Nombre Usuario
$usuario = $_SESSION['username'];

//LISTADO DE CASOS
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

//ENTREGA $caso

require_once '../../librerias/PHPExcel.php';
require_once '../../librerias/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("DESUC")
				->setLastModifiedBy($usuario)
				->setTitle("Informe de Casos")
				->setSubject($nombreProyecto)
				->setDescription("Generado automáticamente por sistema Bunker DESUC")
				->setKeywords("")
				->setCategory("");
//Hoja
$sheet = $objPHPExcel->getActiveSheet();
$tituloHoja= 'Casos al '.$fecha;
$sheet->setTitle($tituloHoja);

//Estilos GENERAL
$styleArray = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );

//ESTILOS ENCABEZADO
$bordeGrueso = array(
    'style' => PHPExcel_Style_Border::BORDER_THICK,
    'color' => array('rgb'=>'000000')
);
$bordeDelgado = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
    'color' => array('rgb'=>'555555')
);

$style_header = array(
'borders' => array(
        'bottom' => $bordeDelgado,
        'left' 	 => $bordeGrueso,
        'top' 	 => $bordeGrueso,
        'right'  => $bordeGrueso,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'4476b5'),
    ),
    'font' => array(
        'bold' => true,
		'name' => 'Arial',
        'size' => '14',
		'color' => array('rgb'=>'FFFFFF'),
    )
);
$styleBordeDerecho = array(
      'borders' => array(
        'bottom' => $bordeDelgado,
        'left' 	 => $bordeDelgado,
        'top' 	 => $bordeDelgado,
        'right'  => $bordeGrueso,
    )
);
$styleBordeIzquierdo = array(
      'borders' => array(
        'bottom' => $bordeDelgado,
        'left' 	 => $bordeGrueso,
        'top' 	 => $bordeDelgado,
        'right'  => $bordeDelgado,
    )
);
$styleBordeAbajo = array(
      'borders' => array(
        'bottom' => $bordeGrueso,
    )
);
$style_blanco = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'FFFFFF'),
    ),
    'font' => array(
        'bold' => false,
		'name' => 'Arial',
        'size' => '11',
    )
);
$style_gris = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb'=>'EEEEEE'),
    ),
    'font' => array(
        'bold' => false,
		'name' => 'Arial',
        'size' => '11',
    )
);

//Encabezados
$encabezados = array('ID', 'Teléfono', 'Estación', 'Encuesta', 'Estado', 'Update', 'ID LimeSurvey');
$sheet->fromArray($encabezados, NULL);
$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('A1:G1')->applyFromArray($styleArray);
$sheet->getStyle('A1:G1')->applyFromArray( $style_header );
$sheet->getColumnDimension('A')->setWidth(12);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(18);
$sheet->getColumnDimension('D')->setWidth(35);
$sheet->getColumnDimension('E')->setWidth(25);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(25);
$sheet->getRowDimension('1')->setRowHeight(25);

$row = 2;
foreach ($caso AS $key=>$rowValue) :
	$sheet->setCellValueByColumnAndRow(0, $row, $rowValue->id_caso);
	$sheet->setCellValueByColumnAndRow(1, $row, $rowValue->telefono);
	$sheet->setCellValueByColumnAndRow(2, $row, $rowValue->usrname);
	$sheet->setCellValueByColumnAndRow(3, $row, $rowValue->encuesta);
	$sheet->setCellValueByColumnAndRow(4, $row, $rowValue->estado);
	$sheet->setCellValueByColumnAndRow(5, $row, $rowValue->fecha2);
	$sheet->setCellValueByColumnAndRow(6, $row, $rowValue->limesurvey_caso);
	
	$sheet->getStyle('B'.$row.':F'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray);
	$sheet->getStyle('A'.$row)->applyFromArray($styleBordeIzquierdo);
	$sheet->getStyle('G'.$row)->applyFromArray($styleBordeDerecho);
	
	$sheet->getRowDimension($row)->setRowHeight(20);
	
	if ($row % 2 == 0) {
	  $sheet->getStyle('A'.$row.':G'.$row)->applyFromArray( $style_blanco );
	} else {
		$sheet->getStyle('A'.$row.':G'.$row)->applyFromArray( $style_gris );
	}
	

	$row++;
endforeach;
$sheet->getStyle('A'.($row-1).':G'.($row-1))->applyFromArray($styleBordeAbajo);
$sheet->getStyle('A2:B'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('C2:E'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getStyle('F2:G'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(FOLDER_UPLOADS.'InformeCasosFueraServicio_'.$nombreProyecto.'_'.$hora.'.xls');

echo FOLDER_UPLOADS.'InformeCasosFueraServicio_'.$nombreProyecto.'_'.$hora.'.xls';

?>
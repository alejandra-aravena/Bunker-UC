<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}?>
<?php
require_once("../../modelo/subida_casos.class.php");
require_once '../../librerias/PHPExcel.php';

$nombreArchivo = $_POST['nombreArchivo'];
$nombreTelefono = $_POST['nombreTelefono'];

$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
$cacheSettings = array( ' memoryCacheSize ' => '10MB');
PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

$inputFileName = '../../uploads/'.$nombreArchivo;
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setReadDataOnly(true);

//$sheetname = 'Data Sheet #2';
//$objReader->setLoadSheetsOnly($sheetname);

$objPHPExcel = $objReader->load($inputFileName);


$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

//******************************************
//OBTENER COLUMNAS *************************
//******************************************
$columnas = array();
for ($col = 0; $col <$highestColumnIndex;++$col) :
		$value=$objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
		if ($value)
			$columnas[$col]=$value; 
	endfor;

$objSubidaCasos = new SubidaCasos();

array_unshift($columnas, "telefono");

foreach ($columnas AS $columna) {
	$columnasString = $columnasString." ".$columna.",";
}
$columnasString = substr($columnasString, 0, -1);

$telefonoColumna = array_search($nombreTelefono, $columnas);

//******************************************
//LEER FILAS Y CELDAS A UN ARRAY ***********
//******************************************
$arraydata = array();
for ($row = 2; $row <= $highestRow;++$row) :
	$arraydata[$row-1][0]=$objWorksheet->getCellByColumnAndRow($telefonoColumna-1, $row)->getValue();
	for ($col = 0; $col <$highestColumnIndex;++$col) :
		$value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
		if ((!$value) && ($col == (count($columnas)-1)))
			echo '';
		else {
			$arraydata[$row-1][$col+1]= addslashes($value); 
		}
	endfor;
endfor;

$arrayValoresString=array();
foreach ($arraydata AS $key=>$data) {
	$valoresString = '';
	foreach ($data AS $value) {
		$valoresString = $valoresString." '".$value."',";
	}
	$valoresString = substr($valoresString, 0, -1);
	$arrayValoresString[$key] = $valoresString;
}

$correctas = 0;
$incorrectas = 0;
$filasIncorrectas = array();
foreach ($arrayValoresString as $key=>$values) {
	$add_caso = $objSubidaCasos->add_caso($columnasString, $values);
	
	if ($add_caso) {
		$correctas++;
	} else {
		$incorrectas++;
		$filasIncorrectas[] = $key;
		$objSubidaCasos->add_casoRepetido($columnasString, $values);
	}
}

$resultado = array(
				'correctas' 		=> $correctas,
				'incorrectas' 		=> $incorrectas,
				'filasIncorrectas'	=> $filasIncorrectas
			);
echo json_encode($resultado);
?>
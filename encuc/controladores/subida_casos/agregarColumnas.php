<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}?>
<?php
require_once("../../modelo/subida_casos.class.php");
require_once '../../librerias/PHPExcel.php';

class MyReadFilter implements PHPExcel_Reader_IReadFilter
{
    public function readCell($column, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row == 1) {
            return true;
        }
        return false;
    }
}

$nombreArchivo = $_POST['nombreArchivo'];

$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
$cacheSettings = array( ' memoryCacheSize ' => '10MB');
PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

$inputFileName = '../../uploads/'.$nombreArchivo;
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setReadDataOnly(true);

//$sheetname = 'Data Sheet #2';
//$objReader->setLoadSheetsOnly($sheetname);
$objReader->setReadFilter( new MyReadFilter() );
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

$resultadoColumnas = array();
foreach ($columnas AS $key=>$columna) {
	$add_columna = $objSubidaCasos->add_columnaBase($columna);
	$add_columna2 = $objSubidaCasos->add_columnaCasoRepetido($columna);
	
	$resultadoColumnas[$key]['columna'] = $columna;
	
	if ($add_columna) {
		$resultadoColumnas[$key]['resultado'] = 'agregada';
	} else {
		$resultadoColumnas[$key]['resultado'] = 'NO AGREGADA';
	}
}

echo json_encode($resultadoColumnas);
<?php
require_once("../../config/config.php");

class Modelo {
	protected $_db;
	
	//Abrir la conexion
	public function __construct() {
		$this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
		
		if ($this->_db->connect_errno) {
			echo "Fallo al conectar a MySQL: ".$this->_db->connect_error;
			return;
		}
		
		$this->_db->set_charset(DB_CHARSET);
	}
	
	function __destruct() {
		$this->_db->close();
	}
	
	//Ejecutar query con resultado array de objetos
	public function queryArray($query) {
		
		$result = $this->_db->query($query);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
		}
		
		//$result->close;
		
		return $rows;
	}
	//Ejecutar query con resultado bool
	public function queryBool($query) {
		return $this->_db->query($query);
	}
	
	//Seleccionar todos los registros de la tabla indicada
	//Entrada:
	//$table: nombre de la tabla
	//Salida: Array de objetos. 
	public function select_all($table) {
		
		$result = $this->_db->query('SELECT * FROM '.$table);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();

		return $rows;
	}
	
	public function select_withFilter($table, $cName, $cValue, $operador) {
		
		$result = $this->_db->query('SELECT * FROM '.$table.' WHERE '.$cName.' '.$operador.' '.$cValue.';');
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();

		return $rows;
	}
	
	//Seleccionar un registro de una tabla segun el indice (numerico)
	public function select_byId($table, $index, $id) {
		
		$result = $this->_db->query('SELECT * FROM '.$table.' WHERE '.$index.' = '.$id);
		
		$row = $result->fetch_object();
		
		$result->close();
		
		return $row;
	}
	
	//Seleccionar un registro de una tabla segun el valor de la columna indicada (alfanumerico)
	public function select_byColumnName($table, $column, $value) {
		
		$result = $this->_db->query('SELECT * FROM '.$table.' WHERE '.$column.' = \''.$value.'\'');
		
		$row = $result->fetch_object();
		
		$result->close();
		
		return $row;
	}
	
	//Borrar registro en funcion del indice dado (numerico)
	public function delete_byId($table, $index, $id) {
		
		$result = $this->_db->query('DELETE FROM '.$table.' WHERE '.$index.' = '.$id);	
		
		return $result;
	}
	//Borrar registro en funcion del 2 indices dados (numericos)
	public function delete_by2Index($table, $index1, $id1, $index2, $id2) {
		
		$result = $this->_db->query('DELETE FROM '.$table.' WHERE '.$index1.' = '.$id1.' AND '.$index2.' = '.$id2);	
		
		return $result;
	}
	
	//Borrar registro en funcion del valor de la columna dada (alfanumerico)
	public function delete_byColumnName($table, $column, $value) {
		
		$result = $this->_db->query('DELETE FROM '.$table.' WHERE '.$column.' = "'.$value.'"');
		
		return $result;
	}
	
	//Agregar una fila
	public function insert_row($table, $columns, $values) {
	
		$columns = implode(", ", $columns);
		$values = implode(", ", $values);
		
		$result = $this->_db->query('INSERT INTO '.$table.' ('.$columns.') VALUES ('.$values.');');
		
		return $result;
	}
	
	//Actualizar una fila segun el indice dado (numerico)
	public function update_row($table, $index, $id, $columns, $values) {
		
		$string = '';
		foreach ($columns AS $i => $name) {
			$string = $string."$name = ".$values[$i].",";
		}
		$string = trim($string, ',');
	
		$result = $this->_db->query('UPDATE '.$table.' SET '.$string.' WHERE '.$index.' = '.$id.'');
		
		return $result;
	}
	public function update_1columnOfrow($table, $index, $id, $column, $value) {
	
		$result = $this->_db->query('UPDATE '.$table.' SET '.$column.' = '.$value.' WHERE '.$index.' = '.$id.'');
		
		return $result;
	}
	
	//Actualizar una columna de una fila segun el indice dado (numerico)
	public function update_column_of_row($table, $index, $id, $column, $value) {
	
		$result = $this->_db->query('UPDATE '.$table.' SET '.$column.' = '.$value.' WHERE '.$index.' = '.$id.'');
		
		return $result;
	}
	
	//Seleccionar los registros de una tabla unida a 2 por indeices numericos
	public function join2tablas($tablaIzq, $tablaC, $tablaDer, $indiceCenIzq, $indiceCenDer, $interes = NULL) {
		
		$result = $this->_db->query('
		SELECT a.'.$indiceCenIzq.', c.'.$indiceCenDer.$interes.' FROM '.$tablaIzq.' a
			LEFT JOIN '.$tablaC.' b ON b.'.$indiceCenIzq.' = a.'.$indiceCenIzq.'
			LEFT JOIN '.$tablaDer.' c ON b.'.$indiceCenDer.' = c.'.$indiceCenDer.'
			ORDER BY a.'.$indiceCenIzq);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();

		return $rows;
	
	}
	
	//Seleccionar los registros de una tabla unida a otra por indeices numericos
	public function join1tablas($tablaIzq, $tablaC, $indice, $interes = NULL) {
		
		$result = $this->_db->query('
		SELECT a.'.$indiceCenIzq.', '.$interes.' FROM '.$tablaIzq.' a
			LEFT JOIN '.$tablaC.' b ON b.'.$indice.' = a.'.$indice.'
			ORDER BY a.'.$indiceCenIzq);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();

		return $rows;
	
	}
	
	//Mostrar las columnas de una tabla
	public function show_columns_of_table($table) {
		$result = $this->_db->query('SHOW COLUMNS FROM '.$table.' FROM '.DB_NAME);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();

		return $rows;
	}
	
	//Agregar columnas a una tabla
	public function add_columns_of_table($table, $column, $type = 'VARCHAR(255)') {
		return $this->_db->query('ALTER TABLE '.$table.' ADD '.$column.' '.$type);
	}
	
	//Editar el nombre y/o el tipo de valores de una columna de una tabla
	public function edit_column_of_table($table, $column, $newColumn, $type = 'VARCHAR(255)') {
		return $this->_db->query('ALTER TABLE '.$table.' CHANGE '.$column.' '.$newColumn.' '.$type);
	}
	
	//Eliminar una columna de una tabla
	public function delete_column_of_table($table, $column) {
		return $this->_db->query('ALTER TABLE '.$table.' DROP '.$column);
	}
}

?>
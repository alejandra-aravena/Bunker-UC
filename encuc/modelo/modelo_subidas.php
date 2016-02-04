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
	//Agregar columnas a una tabla
	public function add_columns_of_table($table, $column, $type = 'VARCHAR(255)') {
		return $this->_db->query('ALTER TABLE '.$table.' ADD '.$column.' '.$type);
	}
	
	//Agregar una fila por string
	public function insert_row($table, $columnsString, $valuesString) {
		
		$result = $this->_db->query('INSERT INTO '.$table.' ('.$columnsString.') VALUES ('.$valuesString.');');
		
		return $result;
	}
}

?>
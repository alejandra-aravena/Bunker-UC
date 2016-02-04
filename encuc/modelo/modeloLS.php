<?php
require_once("../../config/configLS.php");

class ModeloLineSurvey {
	protected $_db;
	
	//Abrir la conexion
	public function __construct() {
		$this->_db = new mysqli(DB_HOST_LS, DB_USER_LS, DB_PASS_LS, DB_NAME_LS);
		
		if ($this->_db->connect_errno) {
			echo "Fallo al conectar a MySQL: ".$this->_db->connect_error;
			return;
		}
		
		$this->_db->set_charset(DB_CHARSET_LS);
	}
	
	//Cerrar la conexion
	public function closeConnection() {
		$this->_db->close();
	}
	
	//Seleccionar todos los registros de la tabla
	//Salida: Array de objetos. 
	public function select_all() {
		
		$result = $this->_db->query('SELECT * FROM '.DB_TABLE_LS);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();
		$this->closeConnection();

		return $rows;
	}
	
	//Seleccionar un registros segun IP
	public function select_byIP($ip) {
		
		$result = $this->_db->query('SELECT * FROM '.DB_TABLE_LS.' WHERE ipaddr = '.$id);
		
		$rows = array();
		while ($obj = $result->fetch_object()) {
			$rows[] = $obj;
    	}
	
		$result->close();
		$this->closeConnection();

		return $rows;
	}
	
	//Seleccionar ultimo registros segun IP
	public function select_lastByIp($ipaddr) {
		
		$result = $this->_db->query("SELECT * FROM ".DB_TABLE_LS." WHERE ipaddr = '".$ipaddr."' ORDER BY datestamp DESC LIMIT 1");
		
		if ($result) {
			$row = $result->fetch_object();
			$result->close();
		} else {
			$row = NULL;
		}
		
		$this->closeConnection();
		
		return $row;
	}
}

?>
<?php
require_once('modelo.php');

class Estados extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'estados';
		$this->singularName = 'estado';
		$this->index = 'id_estado';
		$this->columns = array('estado', 'descripcion', 'visibilidad');
	}
	
	public function get_allEstados() {
		return $this->select_all($this->table);
	}
	public function get_allEstadosAndActividad() {
		$query = 'SELECT * FROM estados a 
					LEFT JOIN estados_acciones b ON b.id_estado = a.id_estado
					LEFT JOIN acciones c ON c.id_accion = b.id_accion';
		
		return $this->queryArray($query);
	}
	
	public function get_estadoById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_estadoByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_estadoById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function del_estadoByName($name) {
		return $this->delete_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function add_estado($estado, $desc = NULL, $visible = 1) {
		
		$values = array("'$estado'", "'$desc'", $visible);
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_estado($id, $estado, $desc, $visible) {
		
		$values = array("'$estado'", "'$desc'", $visible);
		
		return $this->update_row($this->table, $this->index, $id, $this->columns, $values);
	}
	
}
?>
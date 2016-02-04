<?php
require_once('modelo.php');

class ColumnasBase extends Modelo {
	
	protected $table;
	protected $index;
	protected $singularName;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'casos';
		$this->index = 'telefono';
		$this->singularName = 'comuna';
	}
	
	public function get_allColumnasBase() {
		return $this->show_columns_of_table($this->table);
	}
	
	public function del_columnaBase($column) {
		return $this->delete_column_of_table($this->table, $column);
	}
	
	public function add_columnaBase($column, $type = 'VARCHAR(255)') {
		return $this->add_columns_of_table($this->table, $column, $type);
	}
	
	public function edit_columnaBase($column, $newColumn, $type = 'VARCHAR(255)') {	
		return $this->edit_column_of_table($this->table, $column, $newColumn, $type);
	}
}
?>
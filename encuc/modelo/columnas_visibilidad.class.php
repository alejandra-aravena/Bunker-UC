<?php
require_once('modelo.php');

class ColumnasVisibilidad extends Modelo {
	
	protected $table;
	protected $index;
	protected $singularName;
	protected $columns;
	protected $tableBase;
	protected $indexBase;
	protected $singularNameBase;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'columnas_visibilidad';
		$this->index = 'nombre_columna';
		$this->singularName = 'visibilidad';
		$this->columns = array('nombre_columna','visibilidad');
		$this->tableBase = 'casos';
		$this->indexBase = 'id_casos';
		$this->singularNameBase = 'telefono';
	}
	
	public function get_columnasBase() {
		return $this->show_columns_of_table($this->tableBase);
	}
	
	public function add_visibilidadColumna($columna, $visibilidad) {
		$values = array("'$columna'", $visibilidad);
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function get_allVisibilidadColumnas() {
		return $this->select_all($this->table);
	}
	
	public function edit_visibilidadColumna($columna, $visible) {
		return $this->update_1columnOfrow($this->table, $this->index, "'$columna'", $this->singularName, $visible);
	}
	
	public function get_allColumnasVisibles() {
		return $this->select_withFilter($this->table, $this->singularName, 1, '=');
	}
}
?>
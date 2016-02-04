<?php
require_once('modelo_subidas.php');

class SubidaCasos extends Modelo {
	
	protected $table;
	protected $index;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'casos';
		$this->index = 'telefono';
	}
	
	public function add_columnaBase($column, $type = 'VARCHAR(255)') {
		return $this->add_columns_of_table($this->table, $column, $type);
	}
	public function add_columnaCasoRepetido($column, $type = 'VARCHAR(255)') {
		return $this->add_columns_of_table('casos_repetidos', $column, $type);
	}
	
	public function add_caso($stringColumnas, $stringValores) {
		return $this->insert_row($this->table, $stringColumnas, $stringValores);
	}
	public function add_casoRepetido($stringColumnas, $stringValores) {
		return $this->insert_row('casos_repetidos', $stringColumnas, $stringValores);
	}
}
?>
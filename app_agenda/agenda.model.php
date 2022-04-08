<?php 

class Agenda{
	private $id;
	private $id_status;
	private $data_inicial;
	private $data_final;
	private $titulo;
	private $descricao;
	private $cliente;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>
<?php

class vaga {
	private $id;
	private $numero;

    public function __construct($id,$numero) {
		$this->setId($id);
        $this->setNumero($numero);
	}

	public function setId($id) {
		if ($id >= 0) {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function setNumero($numero) {
		if ($numero >= 0) {
			$this->numero = $numero;
		}
	}

	public function getNumero() {
		return $this->numero;
	}

	public function __toString() {
		return "[Vaga] Id: ".$this->id." | ".
		"Número: ".$this->numero;
	}

}

?>
<?php

class vaga extends abstractEntidade {
	private $numero;

    public function __construct($id,$numero) {
		parent::__construct($id);
        $this->setNumero($numero);
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
		return "[Vaga] Parent: ".parent::__toString()." | ".
		"Número: ".$this->numero." | ";
	}
	
}

?>
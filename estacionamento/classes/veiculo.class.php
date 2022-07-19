<?php

class veiculo extends abstractEntidade {
	private $placa;

    public function __construct($id,$placa) {
		parent::__construct($id);
        $this->setPlaca($placa);
	}

	public function setPlaca($placa) {
		if ($placa >= 0) {
			$this->placa = $placa;
		}
	}

	public function getPlaca() {
		return $this->placa;
	}

	public function __toString() {
		return "[Veículo] Parent: ".parent::__toString()." | ".
		"Placa: ".$this->placa." | ";
	}

}

?>
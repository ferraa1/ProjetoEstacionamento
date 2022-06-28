<?php

class veiculo {
	private $id;
	private $placa;

    public function __construct($id,$placa) {
		$this->setId($id);
        $this->setPlaca($placa);
	}

	public function setId($id) {
		if ($id >= 0) {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
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
		return "[Veículo] Id: ".$this->id." | ".
		"Placa: ".$this->placa;
	}

}

?>
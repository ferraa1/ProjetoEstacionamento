<?php

class precoHora {
	private $id;
	private $preco;
	private $atualizado;

    public function __construct($id,$preco,$atualizado) {
		$this->setId($id);
        $this->setPreco($preco);
		$this->setAtualizado($atualizado);
	}

	public function setId($id) {
		if ($id >= 0) {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function setPreco($preco) {
		if ($preco >= 0) {
			$this->preco = $preco;
		}
	}

	public function getPreco() {
		return $this->preco;
	}

	public function setAtualizado($atualizado) {
		if (strlen($atualizado) > 0) {
			$this->atualizado = $atualizado;
		}
	}

	public function getAtualizado() {
		return $this->atualizado;
	}

	public function __toString() {
		return "[Preço/Hora] Id: ".$this->id." | ".
		"Preço: ".$this->preco." | ".
		"Atualizado: ".$this->atualizado;
	}

}

?>
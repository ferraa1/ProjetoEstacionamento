<?php

class precoHora extends abstractEntidade {
	private $preco;
	private $atualizado;

    public function __construct($id,$preco,$atualizado) {
		parent::__construct($id);
        $this->setPreco($preco);
		$this->setAtualizado($atualizado);
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
		return "[Preço/Hora] Parent: ".parent::__toString()." | ".
		"Preço: ".$this->preco." | ".
		"Atualizado: ".$this->atualizado." | ";
	}

}

?>
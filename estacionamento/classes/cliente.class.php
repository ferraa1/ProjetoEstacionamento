<?php

class cliente extends abstractUsuario {
    private $email;
    private $telefone;
    private $veiculos;

    public function __construct($id,$nome,$usuario,$senha,$ativado,$email,$telefone,$veiculos) {
        parent::__construct($id,$nome,$usuario,$senha,$ativado);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setVeiculos($veiculos);
	}

    public function setEmail($email) {
        if (strlen($email) > 0) {
			$this->email = $email;
		}
    }

    public function getEmail() {
        return $this->email;
    }

    public function setTelefone($telefone) {
        if (strlen($telefone) > 0) {
			$this->telefone = $telefone;
		}
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setVeiculos($veiculo) {
        if (is_array($veiculo)) {
			$this->veiculo = $veiculo;
		}
    }

    public function getVeiculos() {
        return $this->veiculo;
    }

	public function __toString() {
		return "[Cliente] Parent: ".parent::__toString()." | ".
        "Email: ".$this->email." | ".
        "Telefone: ".$this->telefone." | ";
	}

}

?>
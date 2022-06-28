<?php

class operacao {
	private $id;
    private $dataEntrada;
    private $dataSaida;
    private $codigo;
    private $funcionario;
    private $vaga;
    private $precoHora;
    private $veiculo;

    public function __construct($id,$dataEntrada,$dataSaida,$codigo,$funcionario,$vaga,$precoHora,$veiculo) {
		$this->setId($id);
        $this->setDataEntrada($dataEntrada);
        $this->setDataSaida($dataSaida);
        $this->setCodigo($codigo);
        $this->setFuncionario($funcionario);
        $this->setVaga($vaga);
        $this->setPrecoHora($precoHora);
        $this->setVeiculo($veiculo);
	}

	public function setId($id) {
		if ($id >= 0) {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
	}

    public function setDataEntrada($dataEntrada) {
        if (strlen($dataEntrada) > 0) {
            $this->dataEntrada = $dataEntrada;
        }
    }

    public function getDataEntrada($dataEntrada) {
        return $this->dataEntrada;
    }

    public function setDataSaida($dataSaida) {
        if (strlen($dataSaida) > 0) {
            $this->dataSaida = $dataSaida;
        }
    }

    public function getDataSaida($dataSaida) {
        return $this->dataSaida;
    }

    public function setCodigo($codigo) {
        if (strlen($codigo) > 0) {
            $this->codigo = $codigo;
        }
    }

    public function getCodigo($codigo) {
        return $this->codigo;
    }

    public function setFuncionario($funcionario) {
        if ($funcionario > 0) {
            $this->funcionario = $funcionario;
        }
    }

    public function getFuncionario($funcionario) {
        return $this->funcionario;
    }

    public function setVaga($vaga) {
        if ($vaga > 0) {
            $this->vaga = $vaga;
        }
    }

    public function getVaga($vaga) {
        return $this->vaga;
    }

    public function setPrecoHora($precoHora) {
        if ($precoHora > 0) {
            $this->precoHora = $precoHora;
        }
    }

    public function getPrecoHora($precoHora) {
        return $this->xyz;
    }

    public function setVeiculo($veiculo) {
        if ($veiculo > 0) {
            $this->veiculo = $veiculo;
        }
    }

    public function getVeiculo($veiculo) {
        return $this->veiculo;
    }

	public function __toString() {
		return "[Operação] Id: ".$this->id." | ".
		"Data de Entrada: ".$this->dataEntrada." | ".
        "Data de Saída: ".$this->dataSaida." | ".
        "Código: ".$this->codigo." | ".
        "Funcionário: ".$this->funcionario." | ".
        "Vaga: ".$this->vaga." | ".
        "Preço/Hora: ".$this->precoHora." | ".
        "Veículo: ".$this->veiculo;
	}

}

?>
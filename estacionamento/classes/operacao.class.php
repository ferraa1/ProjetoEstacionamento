<?php

class operacao extends abstractEntidade {
    private $dataEntrada;
    private $dataSaida;
    private $funcionario;
    private $vaga;
    private $precoHora;
    private $veiculo;

    public function __construct($id,$dataEntrada,$dataSaida,$funcionario,$vaga,$precoHora,$veiculo) {
		parent::__construct($id);
        $this->setDataEntrada($dataEntrada);
        $this->setDataSaida($dataSaida);
        $this->setFuncionario($funcionario);
        $this->setVaga($vaga);
        $this->setPrecoHora($precoHora);
        $this->setVeiculo($veiculo);
	}

    public function setDataEntrada($dataEntrada) {
        if (strlen($dataEntrada) > 0) {
            $this->dataEntrada = $dataEntrada;
        }
    }

    public function getDataEntrada() {
        return $this->dataEntrada;
    }

    public function setDataSaida($dataSaida) {
        if (strlen($dataSaida) > 0) {
            $this->dataSaida = $dataSaida;
        }
    }

    public function getDataSaida() {
        return $this->dataSaida;
    }

    public function setFuncionario($funcionario) {
        if ($funcionario != null) {
            $this->funcionario = $funcionario;
        }
    }

    public function getFuncionario() {
        return $this->funcionario;
    }

    public function setVaga($vaga) {
        if ($vaga != null) {
            $this->vaga = $vaga;
        }
    }

    public function getVaga() {
        return $this->vaga;
    }

    public function setPrecoHora($precoHora) {
        if ($precoHora != null) {
            $this->precoHora = $precoHora;
        }
    }

    public function getPrecoHora() {
        return $this->precoHora;
    }

    public function setVeiculo($veiculo) {
        if ($veiculo != null) {
            $this->veiculo = $veiculo;
        }
    }

    public function getVeiculo() {
        return $this->veiculo;
    }

	public function __toString() {
		return "[Operação] Parent: ".parent::__toString()." | ".
		"Data de Entrada: ".$this->dataEntrada." | ".
        "Data de Saída: ".$this->dataSaida." | ".
        "Funcionário: ".$this->funcionario->__toString()." | ".
        "Vaga: ".$this->vaga->__toString()." | ".
        "Preço/Hora: ".$this->precoHora->__toString()." | ".
        "Veículo: ".$this->veiculo->__toString()." | ";
	}

    public function calcHoras() {
        if ($this->dataSaida == null) {
            return abs(strtotime(date('Y-m-d H:i:s')) - strtotime($this->dataEntrada))/(60*60);
        } else {
            return abs(strtotime($this->dataSaida) - strtotime($this->dataEntrada))/(60*60);
        }
    }

    public function calcPreco() {
        return $this->calcHoras() * $this->precoHora->getPreco();
    }

}

?>
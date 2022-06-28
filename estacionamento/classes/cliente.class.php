<?php

class cliente {
	private $id;
	private $nome;
    private $usuario;
    private $senha;
    private $email;
    private $telefone;
    private $ativado;

    public function __construct($id,$nome,$usuario,$senha,$email,$telefone,$ativado) {
		$this->setId($id);
        $this->setNome($nome);
        $this->setUsuario($usuario);
        $this->setSenha($senha);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setAtivado($ativado);
	}

	public function setId($id) {
		if ($id >= 0) {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function setNome($nome) {
		if (strlen($nome) > 0) {
			$this->nome = $nome;
		}
	}

	public function getNome() {
		return $this->nome;
	}

    public function setUsuario($usuario) {
        if (strlen($usuario) > 0) {
			$this->usuario = $usuario;
		}
    }

    public function getUsuario() {
        $this->x = $usuario;
    }

    public function setSenha($senha) {
        if (strlen($senha) > 0) {
			$this->senha = $senha;
		}
    }

    public function getSenha() {
        $this->x = $senha;
    }

    public function setEmail($email) {
        if (strlen($email) > 0) {
			$this->email = $email;
		}
    }

    public function getEmail() {
        $this->x = $email;
    }

    public function setTelefone($telefone) {
        if (strlen($telefone) > 0) {
			$this->telefone = $telefone;
		}
    }

    public function getTelefone() {
        $this->x = $telefone;
    }

    public function setAtivado($ativado) {
        if ($ativado == true || $ativado == false) {
			$this->ativado = $ativado;
		}
    }

    public function getAtivado() {
        $this->x = $ativado;
    }

	public function __toString() {
		return "[Cliente] Id: ".$this->id." | ".
		"Nome: ".$this->nome." | ".
        "Usuário: ".$this->usuario." | ".
        "Senha: ".$this->senha." | ".
        "Email: ".$this->email." | ".
        "Telefone: ".$this->telefone." | ".
        "Ativado: ".$this->ativado." | ";
	}

}

?>
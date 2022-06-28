<?php

class funcionario {
	private $id;
	private $nome;
    private $usuario;
    private $senha;
    private $admin;
    private $ativado;

    public function __construct($id,$nome,$usuario,$senha,$admin,$ativado) {
		$this->setId($id);
        $this->setNome($nome);
        $this->setUsuario($usuario);
        $this->setSenha($senha);
        $this->setAdmin($admin);
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

    public function setAdmin($admin) {
        if ($admin == true || $admin == false) {
			$this->admin = $admin;
		}
    }

    public function getAdmin() {
        $this->x = $admin;
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
		return "[Funcionário] Id: ".$this->id." | ".
		"Nome: ".$this->nome." | ".
        "Usuário: ".$this->usuario." | ".
        "Senha: ".$this->senha." | ".
        "Admin: ".$this->admin." | ".
        "Ativado: ".$this->ativado." | ";
	}

}

?>
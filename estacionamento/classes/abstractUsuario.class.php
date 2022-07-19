<?php

class abstractUsuario extends abstractEntidade {
    private $nome;
    private $usuario;
    private $senha;
    private $ativado;

    public function __construct($id,$nome,$usuario,$senha,$ativado) {
      parent::__construct($id);
      $this->setNome($nome);
      $this->setUsuario($usuario);
      $this->setSenha($senha);
      $this->setAtivado($ativado);
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
      return $this->usuario;
    }
  
    public function setSenha($senha) {
      if (strlen($senha) > 0) {
        $this->senha = $senha;
      }
    }
  
    public function getSenha() {
      return $this->senha;
    }
  
    public function setAtivado($ativado) {
      if (is_bool($ativado) || $ativado == 1 || $ativado == 0) {
        $this->ativado = $ativado;
      }
    }
  
    public function getAtivado() {
      return $this->ativado;
    }
  
    public function __toString() {
      return "[abstractUsuario] Parent: ".parent::__toString()." | ".
      "Nome: ".$this->nome." | ".
      "Usuário: ".$this->usuario." | ".
      "Senha: ".$this->senha." | ".
      "Ativado: ".$this->ativado." | ";
    }

}

?>
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
  
    public function setAtivado($ativado) {
      if ($ativado == true || $ativado == false) {
        $this->ativado = $ativado;
      }
    }
  
    public function getAtivado() {
      $this->x = $ativado;
    }
  
}

?>
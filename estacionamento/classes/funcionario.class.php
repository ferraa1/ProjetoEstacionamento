<?php

class funcionario extends abstractUsuario {
    private $admin;

    public function __construct($id,$nome,$usuario,$senha,$ativado,$admin) {
        parent::__construct($id,$nome,$usuario,$senha,$ativado);
        $this->setAdmin($admin);
	}

    public function setAdmin($admin) {
        if (is_bool($admin) || $admin == 1 || $admin == 0) {
			$this->admin = $admin;
		}
    }

    public function getAdmin() {
        return $this->admin;
    }

	public function __toString() {
		return "[Funcionário] Parent: ".parent::__toString()." | ".
        "Admin: ".$this->admin." | ";
	}

}

?>
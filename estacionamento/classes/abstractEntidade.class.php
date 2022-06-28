<?php

class abstractEntidade {
    private $id;

    public function __construct($id) {
		$this->setId($id);
	}

    public function setId($id) {
		if ($id >= 0) {
			$this->id = $id;
		}
	}

	public function getId() {
		return $this->id;
	}
    
}

?>
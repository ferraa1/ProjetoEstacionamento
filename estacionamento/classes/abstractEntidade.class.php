<?php

class abstractEntidade {
    private $id;

    public function __construct($id = null) {
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

	public function __toString() {
		return "[abstractEntidade] Id: ".$this->id." | ";
	}
	
}

?>
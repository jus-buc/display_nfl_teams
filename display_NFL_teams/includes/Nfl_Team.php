<?php

class Nfl_Team {
	private $id;
	private $name;

	public function __construct($id, $name) {
		$this->id 			= $id;
		$this->name 		= $name;
	}

	public function get_Name() {
		return $this->name;
	}
}

?>
<?php 

class Nfl_Conference {
	private $name;

	// An array containing all the NFL Divisions which belong to this Conference instance
	private $divisions = [];

	public function __construct($name) {
		$this->name = $name;
	}

	// Adds a Division to the conference
	public function add_Division($division) {
		if ( !array_key_exists($division->get_Name(), $this->divisions) ) {
			$this->divisions[$division->get_Name()] = $division;
		}
	}

	// Checks if a Division already exists within this conference. Used when creating the data structure at initialization
	public function does_Division_Exist($division_name) {
		if ( array_key_exists($division_name, $this->divisions) ) {
			return true;
		} 
		return false;
	}

	// Uses a Division name to get a specific Division instance
	public function get_Division_Instance($division_name) {
		return $this->divisions[$division_name];
	}

	// Retrieves all Divisions. Used when generating the HTML for display
	public function get_Divisions() {
		return $this->divisions;
	}

	// Gets the name of the Conference
	public function get_Name() {
		return $this->name;
	}
}

?>
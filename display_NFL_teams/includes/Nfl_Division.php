<?php 

class Nfl_Division {
	private $name;

	// An array of NFL teams which belong to this division
	private $teams = [];

	public function __construct($name) {
		$this->name = $name;
	}

	// Adds a team to the division. Used when the data structure is initialized
	public function add_Team($team) {
		if(!array_key_exists($team->get_Name(), $this->teams)) {
			$this->teams[$team->get_Name()] = $team;
		}
	}

	// Checks to see if a team exists in this division. Used during initialization
	public function does_Team_Exist($team_name) {
		if(array_key_exists($team_name, $this->teams)) {
			return true;
		}
		return false;
	}

	// Returns the name of the division
	public function get_Name() {
		return $this->name;
	}

	// Returns all the teams which are in this division. Used when generating HTML for display.
	public function get_Teams() {
		return $this->teams;
	}
}

?>
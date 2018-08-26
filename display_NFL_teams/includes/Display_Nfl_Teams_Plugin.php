<?php

class Display_Nfl_Teams_Plugin {

	// Contains the NFL conference class instances
	private $conferences = [];

	public function __construct() {
		// On initialization, the constructor grabs the JSON team data and converts it to class instances
		$this->get_Team_Data();

		// Adds the WP shortcode and assigns a template for displaying the HTML
		add_shortcode('display_nfl_teams', array($this, 'set_Shortcode_Template') );
	}

	// Makes this class instance available to the HTML template for display
	public function set_Shortcode_Template() {
		$nfl_plugin_object = $this;
		require_once PLUGIN_DIR . '/public/display_nfl_teams_template.php';
	}

	// Returns all the conference class instances
	public function get_Conferences() {
		return $this->conferences;
	}

	// Checks if a conference class instance has already been created. Used during initialization
	public function does_Conference_Exist($conference_name) {
		if (array_key_exists($conference_name, $this->conferences)) {
			return true;
		}
		return false;
	}

	// Reads the JSON from the URL constant, and sends the result to another method to get processed into a data structure
	public function get_Team_Data() {
		$raw_data 			= file_get_contents(DATA_SOURCE); 
		$decoded_data 		= json_decode($raw_data, true);
		$team_data 			= $decoded_data['results']['data']['team'];

		$this->set_Team_Data_Structure($team_data);
	}

	// Creates class instances for each conference, division, and team, and groups them into a hierarchical format for ease of display
	public function set_Team_Data_Structure($team_data) {
		foreach ($team_data as $key => $team) {
			$team_name 			= $team['name'];
			$team_id 			= $team['id'];
			$conference_name 	= $team['conference'];
			$division_name 		= $team['division'];

			// Checks if a conference has already been created. If not, we can assume that no division or team object has been created either
			if ($this->does_Conference_Exist($conference_name)) {
				$current_conference = $this->conferences[$conference_name];

				// Checks if a division instance has already been created and added to the current conference. If not, create one and add the current team to it
				if( $current_conference->does_Division_Exist($division_name) ) {
					$current_division = $current_conference->get_Division_Instance($division_name);
					$new_team = new Nfl_Team($team_id, $team_name);
					$current_division->add_Team($new_team);
				} else {
					$new_division = new Nfl_Division($division_name);
					$new_team = new Nfl_Team($team_id, $team_name);

					$new_division->add_Team($new_team);
					$current_conference->add_Division($new_division);
				}
			} else {
				$new_conference = new Nfl_Conference($conference_name);
				$new_division = new Nfl_Division($division_name);
				$new_team = new Nfl_Team($team_id, $team_name);

				$new_division->add_Team($new_team);
				$new_conference->add_Division($new_division);
				$this->conferences[$conference_name] = $new_conference;
			}
		}
	}

}

?>
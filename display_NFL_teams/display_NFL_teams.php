<?php
/*
Plugin Name: Display NFL teams
Plugin URI: http://www.justinbuckley.net
Description: Displays NFL teams by conference and division
Author: Justin Buckley
Version: 1.0
Author URI: http://www.justinbuckley.net
*/

define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DATA_SOURCE', 'http://delivery.chalk247.com/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0');

// Add Bootstrap JS and CSS
wp_register_style('nfl_teams_bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
wp_enqueue_style('nfl_teams_bootstrap_css');

wp_register_script('nfl_teams_bootstrap_js', 'https://code.jquery.com/jquery-3.3.1.slim.min.js');
wp_enqueue_script('nfl_teams_bootstrap_js');

wp_register_script('nfl_teams_bootstrap_popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
wp_enqueue_script('nfl_teams_bootstrap_popper');

wp_register_script('nfl_teams_bootstrap_bs_js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
wp_enqueue_script('nfl_teams_bootstrap_bs_js');

// Include class files
require_once 'includes/Display_Nfl_Teams_Plugin.php';
require_once 'includes/Nfl_Team.php';
require_once 'includes/Nfl_Division.php';
require_once 'includes/Nfl_Conference.php';

// Initialize plugin
$nfl_plugin = new Display_Nfl_Teams_Plugin();

?>
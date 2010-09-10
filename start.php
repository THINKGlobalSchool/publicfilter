<?php
	/**
	 * Public filter start.php
	 * 
	 * @package PublicFilter
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
	
	// Init
	function publicfilter_init() {
		global $CONFIG;
		
		// Page handler
		//register_page_handler('publicfilter','publicfilter_page_handler');
		
		// Register a handler for creating objects
		//register_elgg_event_handler('create', 'object', 'publicfilter_create_event_listener');
		
		// Register a handler for updating 
		//register_elgg_event_handler('update', 'all', 'publicfilter_update_event_listener');
	}
	
	/**
	 * Object created, check for public access
	 */
	function publicfilter_create_event_listener($event, $object_type, $object) {
		return true;
	}
	
	/**
	 * Object updated, check for public access
	 */
	function publicfilter_update_event_listener($event, $object_type, $object) {
		return true;
	}
	
	/** 
	 * Gets a the list of users to filter again
	 * from the plugin settings
	 * 
	 */
	function publicfilter_get_users() {
		// Get contacts from plugin settings
		$users = get_plugin_setting('userlist','publicfilter');
		$users = explode("\n", $users);
		$users_array = array();
		foreach ($users as $idx => $user) {
			$users_array[] = $user;
		}
		return $users_array;
	}

	register_elgg_event_handler('init', 'system', 'publicfilter_init');
?>
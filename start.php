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
			$users_array[] = trim($user);
		}
		return $users_array;
	}

	register_elgg_event_handler('init', 'system', 'publicfilter_init');
?>
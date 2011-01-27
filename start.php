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
		
		// Listen to create events, setting low priority
		register_elgg_event_handler('create','all','publicfilter_access_listener', 2000);
		
		// Listen to update event, setting low priority
		register_elgg_event_handler('update','all','publicfilter_access_listener', 2000);
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
	
	/** 
	 * Gets a the list of mod specified mod users
	 * 
	 */
	function publicfilter_get_mods() {
		// Get contacts from plugin settings
		$users = get_plugin_setting('modlist','publicfilter');
		$users = explode("\n", $users);
		$users_array = array();
		foreach ($users as $idx => $user) {
			$user = get_user_by_username(trim($user));
			$users_array[] = $user;
			
		}
		return $users_array;
	}
	
	
	/**
	 * Listen to the create/update events and fire off a notification if moderation is enabled
	 */
	function publicfilter_access_listener($event, $object_type, $object) {	
		global $CONFIG;
		
		$object_type_exceptions = array(
			'user', 
			'metadata'
		);
		
		$object_allowed_subtypes = array(
			'thewire', 
			'blog', 
			'album', 
			'file', 
			'feedback',
			'simplekaltura_video',
			'rubric',
			'resourcerequest',
			'document',
			'groupforumtopic',
			'todo',
			'batch',
			'announcement',
			'shared_doc',
			'ubertag',
			'poll'
		);
		
		// Groups are always public, so notify on create, but not on updates
		if ($event == 'update') {
			$object_type_exceptions[] = 'group';
		}
		
		if (get_plugin_setting('modsenabled','publicfilter') 
			&& !in_array($object_type, $object_type_exceptions)
			&& in_array($object->getSubtype(), $object_allowed_subtypes)
			&& $object->access_id == ACCESS_PUBLIC) {
			$mods = publicfilter_get_mods();
			
			global $CONFIG;
			
			$owner = get_entity($object->owner_guid);
			foreach($mods as $mod) {
				if ($mod) {
					notify_user( 
						$mod->getGUID(), $CONFIG->site->guid, 
						elgg_echo('publicfilter:notifymod:subject'), 
						elgg_echo('publicfilter:notifymod:body', array($object_type, $object->getSubtype(), $object->getURL()))
					);
				}
			}
		}
	}

	register_elgg_event_handler('init', 'system', 'publicfilter_init');
?>
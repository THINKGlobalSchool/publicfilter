<?php
	/**
	 * Parent Filter language file
	 * 
	 * @package ParentFilter
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
	
	$english = array(
		
		// Titles/Label
		'publicfilter:label:userlist' => "User's to filter",
		'publicfilter:label:filterusers' => "Prevent specific user's from creating public content: ",
		'publicfilter:label:enablemods' => 'Enabled moderators',
			
		// Notifications
		'publicfilter:notifymod:subject' => 'Spot Public Content Notice',
		'publicfilter:notifymod:body' => '%s has marked content as public. 

Object type: %s
Object subtype: %s
		
Click here to view: %s

',
			
		// Other

	);

	add_translation('en',$english);
?>
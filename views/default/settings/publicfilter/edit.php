<?php
	/**
	 * Public Filter settings form
	 * 
	 * @package ParentFilter
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
?>
<p>
    <label><?php echo elgg_echo('publicfilter:label:userlist'); ?></label><br />
    <?php 
	echo elgg_view('input/plaintext', array(
										'internalname' => 'params[userlist]', 
										'value' => $vars['entity']->userlist)
										); 
	?>
</p>

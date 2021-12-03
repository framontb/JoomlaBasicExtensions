<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_buscador_site
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

/**
 * Specialty Form Field class for the com_buscador_site component
 *
 * @since  0.0.1
 */
class JFormFieldSpecialty extends JFormField {
	
	protected $type = 'Specialty';

	// getLabel() left out

	public function getInput() {
        $app        = JFactory::getApplication();
        $db         = JFactory::getDBO();

        // Get State
        $filters    = $app->getUserStateFromRequest($this->context . '.filter', 'filter', array(), 'array');
        $profession_filter = $filters['profession'];;
        $specialty_filter  = $filters['specialty'];
        // dump($filters,'$filters');

        // Get specialties
		$query = $db->getQuery(true);
		$query->select('DISTINCT bs.specialty');
		$query->from('#__buscador_site as bs');
		$query->where('bs.profession = '.$db->quote($profession_filter));
		$db->setQuery((string) $query);
		$specialties_db = $db->loadColumn();

        // Build options
        $options  = '<option value>All</option>';
        foreach ($specialties_db as $specialty_db) 
        {
            $selected = ($specialty_filter ==  $specialty_db)?'selected="selected"':'';
            $options .= "<option value='$specialty_db' $selected>$specialty_db</option>";
        }
		
        // Build select
		return '<select id="'.$this->id.'" name="'.$this->name.'">'.$options.'</select>';
	}
}
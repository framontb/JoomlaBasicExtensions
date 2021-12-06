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
        // Get State
        $app        = JFactory::getApplication();
        $filters    = $app->getUserStateFromRequest($this->context . '.filter', 'filter', array(), 'array');
        $profession_filter = $filters['profession'];;
        $specialty_filter  = $filters['specialty'];
        // dump($filters,'$filters');

        // Get Specialties
        $ajaxModel = JModelLegacy::getInstance('Ajax', 'Buscador_siteModel');
        $specialties_db = array();
        if ($ajaxModel->existProfession($profession_filter)) 
        {
            $specialties_db = $ajaxModel->getSpecialtiesByProfession($profession_filter);
        }

        // Build options
        $options  = '<option value>All</option>';
        foreach ($specialties_db as $specialty_db) 
        {
            $selected = ($specialty_filter ==  $specialty_db)?'selected="selected"':'';
            $specialty_db_tranlated = JText::_($specialty_db);
            $options .= "<option value='$specialty_db' $selected>$specialty_db_tranlated</option>";
        }
        
        // Build select
        return '<select id="'.$this->id.'" name="'.$this->name.'">'.$options.'</select>';
    }
}
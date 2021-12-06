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
 * Ramajax Form Field class for dynamic ajax combo select
 *
 * @since  0.0.1
 */
class JFormFieldRamajax extends JFormField {
    
    protected $type = 'Ramajax';

    // getLabel() left out

    public function getInput() 
    {
        // Get State
        $app        = JFactory::getApplication();
        $filters    = $app->getUserStateFromRequest($this->context . '.filter', 'filter', array(), 'array');

        // Get the name and table of the master field from the Form,
        // and the value selected by the user from the Request
        $masterFieldName  = (string) $this->element['masterFieldName'];
        $masterFieldValue = $filters[$masterFieldName];
        $masterFieldTable = (string) $this->element['masterFieldTable'];

        // Get the name and table of the slave field from the Form,
        // and the value selected by the user from the Request
        $slaveFieldName  = (string) $this->element['slaveFieldName'];
        $slaveFieldValue = $filters[$slaveFieldName];
        $slaveFieldTable = (string) $this->element['slaveFieldTable'];

        // Get Specialties
        $ajaxModel = JModelLegacy::getInstance('Ajax', 'Buscador_siteModel');
        $slavesFromDb = array();
        if ($ajaxModel->existMasterField($masterFieldName,$masterFieldValue)) 
        {
            $slavesFromDb = $ajaxModel->getSlaveValues($masterFieldName,$masterFieldValue,$slaveFieldName);
        }

        // Build options
        $options  = '<option value>All</option>';
        foreach ($slavesFromDb as $slaveDb) 
        {
            $selected = ($slaveFieldValue ==  $slaveDb)?'selected="selected"':'';
            $slaveDbTranslated = JText::_($slaveDb);
            $options .= "<option value='$slaveDb' $selected>$slaveDbTranslated</option>";
        }
        
        // Build select
        return '<select id="'.$this->id.'" name="'.$this->name.'">'.$options.'</select>';
    }
}
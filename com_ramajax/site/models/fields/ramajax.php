<?php
/**
 * Ramajax
 * @version      $Id$
 * @package      ramajax
 * @copyright    Copyright (C) 2021 framontb. All rights reserved.
 * @license      GNU/GPL
 * @link         https://github.com/framontb/JoomlaBasicExtensions
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

        # RAM DEBUG
        #return "<p>$masterFieldName</br>$masterFieldValue</br>$masterFieldTable</p>";

        // Get Specialties
        JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_ramajax/models');
        $ajaxModel = JModelLegacy::getInstance('Ajax', 'RamajaxModel');

        $slaveOptions = "";
        if (empty($masterFieldValue )) {$masterFieldValue="";}
        if (empty($slaveFieldValue )) {$slaveFieldValue="";}
        if (!$ajaxModel->existMasterField($masterFieldName,$masterFieldValue)) {$masterFieldValue ='';}  
        $slaveOptions = $ajaxModel->getSlaveOptions($masterFieldName,$masterFieldValue,$slaveFieldName,$slaveFieldValue);

        // Build select
        return '<select id="'.$this->id.'" name="'.$this->name.'">'.$slaveOptions.'</select>';
    }
}
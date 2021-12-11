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

// Add Logger - RAM DEBUG
use Joomla\CMS\Log\Log;
if (JDEBUG) {
    JLog::addLogger(
        array(
            // Sets file name
            'text_file' => 'com_ramajax.log.php'
        ),
        // Sets messages of all log levels to be sent to the file.
        JLog::ALL,
        // The log category/categories which should be recorded in this file.
        // In this case, it's just the one category from our extension.
        // We still need to put it inside an array.
        array('com_ramajax')
    );
    JLog::add('************** JFormFieldRamajax *****************', JLog::INFO, 'com_ramajax');
}

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
        // Get Model
        JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_ramajax/models');
        $ajaxModel = JModelLegacy::getInstance('Ajax', 'RamajaxModel');

        // Get State
        $app        = JFactory::getApplication();
        $filters    = $app->getUserStateFromRequest('filter', 'filter', array(), 'array');

        // Ramajax Field
        $ramajaxName  = (string) $this->element['name'];

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

        // Get field values
        $slaveOptions = "";
        if (empty($masterFieldValue )) {$masterFieldValue="";}
        if (empty($slaveFieldValue )) {$slaveFieldValue="";}
        if (!$ajaxModel->existMasterField($slaveFieldName,$masterFieldValue)) {$masterFieldValue ='';}  
        $slaveOptions = $ajaxModel->getSlaveOptions($masterFieldName,$masterFieldValue,$slaveFieldName,$slaveFieldValue);

        // RAM DEBUG
        if (JDEBUG) {
            JLog::add('===> $ramajaxName = '.$ramajaxName . " <===", JLog::INFO, 'com_ramajax');
            JLog::add($masterFieldName. ' = '.$masterFieldValue, JLog::INFO, 'com_ramajax');
            JLog::add($slaveFieldName. ' = '.$slaveFieldValue, JLog::INFO, 'com_ramajax');
        }

        // Build select
        return '<select id="'.$this->id.'" name="'.$this->name.'">'.$slaveOptions.'</select>';
    }
}
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
 *       <field 
 *          name="player" 
 *          type="ramajax" 
 *          label="Select a player"
 *          slaveFieldName="player"
 *          slaveFieldTable="#__ramajax_use_example"
 *       />
 *
 * @since  0.0.1
 */
class JFormFieldRamajaxSelectAlone extends JFormField {
    
    protected $type = 'ramajaxselectalone';

    public array $ramDef; // Ramajax Definition
    public $ajaxModel;

    // Constructor
    public function __construct(\Joomla\CMS\Form\Form $form = null) 
    {
        parent::__construct($form);

        // Get Model
        JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_ramajax/models');
        $this->ajaxModel = JModelLegacy::getInstance('Ajax', 'RamajaxModel');
    }

    // getLabel() left out

    public function getInput() 
    {
        // Get State
        $app        = JFactory::getApplication();
        $filters    = $app->getUserStateFromRequest('filter', 'filter', array(), 'array');

        // Ramajax Field
        $this->ramDef = array();
        $this->ramDef['ramajaxName']    = (string) $this->element['name'];
        $this->ramDef['type']           = (string) $this->element['type'];
        $this->ramDef['emptyValueText']  = (string) $this->element['emptyValueText'];

        // Get the name and table of the slave field from the Form,
        // and the value selected by the user from the Request
        $this->ramDef['slaveFieldName']  = (string) $this->element['slaveFieldName'];
        $this->ramDef['slaveFieldValue'] = $filters[$this->ramDef['slaveFieldName']];
        $this->ramDef['slaveFieldTable'] = (string) $this->element['slaveFieldTable'];
        
        /**
         * Get the ramajax field state in db:
         *      -1 conflict detected
         *       0 all is OK, ramajax field provisioned
         *       1 ramajax field not provisined jet
         */
        $ramajaxState = $this->ajaxModel->getRamajaxStateDb($this->ramDef);

        // all good
        if (!$ramajaxState) {}

        // provision needed
        elseif ($ramajaxState == 1) { $this->ajaxModel->storeRamajaxInDb($this->ramDef);} 
        
        // conflict detected
        elseif ($ramajaxState == -1)
        {
            // @TODO: DEBUG  error
            // update en lugar de store
            //$this->ajaxModel->storeRamajaxInDb($this->ramDef);
            //raise error
            JLog::add('====> ramajax field: conflict detected: '.$this->ramDef['ramajaxName'], JLog::INFO, 'com_ramajax');
        }

        // Get field values or empty strings
        if (empty($this->ramDef['slaveFieldValue'])) {$this->ramDef['slaveFieldValue']="";}

        $slaveOptions = $this->ajaxModel->getSelectAloneOptions(
            $this->ramDef['ramajaxName'],
            $this->ramDef['slaveFieldValue']);

        // Build select
        return '<select id="'.$this->id.'" name="'.$this->name.'">'.$slaveOptions.'</select>';
    }
}
<?php
/**
 * Ramajax
 * @version      $Id$
 * @package      ramajax
 * @copyright    Copyright (C) 2021 framontb. All rights reserved.
 * @license      GNU/GPL
 * @link         https://github.com/framontb/JoomlaBasicExtensions
 */

use \Joomla\CMS\Response\JsonResponse;

class RamajaxControllerAjax extends JControllerLegacy
{
    // Properties
    private String $masterFieldName;
    private String $slaveFieldName;
    private String $masterFieldValue;
    private $model;

    /**
     * Constructor class
     */
    public function __construct()
    {
        parent::__construct();

        # Get the model
        $this->model = $this->getModel('ajax');

        # master/slave field Variables
        $this->masterFieldName    = JFactory::getApplication()->input->get('masterFieldName','','STRING');        
        $this->slaveFieldName     = JFactory::getApplication()->input->get('slaveFieldName','','STRING');
        $this->masterFieldValue   = JFactory::getApplication()->input->get($this->masterFieldName,'','STRING');

        # If empty $masterFieldValue, or $masterFieldValue not in bd => nothing to do
        if (empty($this->masterFieldValue) or (!$this->model->existMasterField($this->masterFieldName, $this->masterFieldValue))) 
        {
            $this->masterFieldValue = "";
        }

        # RAM DEBUG
        if (JDEBUG) { 
            JLog::add('$this->masterFieldValue : '.$this->masterFieldName.' = '.$this->masterFieldValue, JLog::INFO, 'com_ramajax');
            JLog::add('$this->slaveFieldName : '.$this->slaveFieldName, JLog::INFO, 'com_ramajax');
        }
    }

    /**
     * Get the slave raw values from the database
     */
    public function getSlaveValues()
    {
        try
        {
            $slaveValues = $this->model->getSlaveValues(
                $this->masterFieldName,
                $this->masterFieldValue,
                $this->slaveFieldName);

            $response = new JsonResponse($slaveValues);
            echo $response;
        }
        catch(Exception $e)
        {
            echo new JsonResponse($e);
        }
    }

    /**
     * Get the slave Options from the database
     */
    public function getSlaveOptions()
    {
        try
        {
            $slaveOptions = $this->model->getSlaveOptions(
                $this->masterFieldName,
                $this->masterFieldValue,
                $this->slaveFieldName);

            $response = new JsonResponse($slaveOptions);
            echo $response;
        }
        catch(Exception $e)
        {
            echo new JsonResponse($e);
        }
    }
}
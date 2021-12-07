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
    // Get the slave raw values from the database
    public function getSlaveValues()
    {
        try
        {
            # Get the model
            $model = $this->getModel('ajax');

            # master/slave field Variables
            $masterFieldName    = JFactory::getApplication()->input->get('masterFieldName','','WORD');        
            $slaveFieldName     = JFactory::getApplication()->input->get('slaveFieldName','','WORD');
            $masterFieldValue   = JFactory::getApplication()->input->get($masterFieldName,'','WORD');

            # If empty $masterFieldValue, or $masterFieldValue not in bd => nothing to do
            if (empty($masterFieldValue) or (!$model->existMasterField($masterFieldName,$masterFieldValue))) 
            {
                $masterFieldValue = "";
            }

            $slaveValues = $model->getSlaveValues($masterFieldName,$masterFieldValue,$slaveFieldName);
            $response = new JsonResponse($slaveValues);
            echo $response;
        }
        catch(Exception $e)
        {
            echo new JsonResponse($e);
        }
    }

    // Get the slave Options from the database
    public function getSlaveOptions()
    {
        try
        {
            # Get the model
            $model = $this->getModel('ajax');

            # master/slave field Variables
            $masterFieldName    = JFactory::getApplication()->input->get('masterFieldName','','WORD');        
            $slaveFieldName     = JFactory::getApplication()->input->get('slaveFieldName','','WORD');
            $masterFieldValue   = JFactory::getApplication()->input->get($masterFieldName,'','WORD');

            # If empty $masterFieldValue, or $masterFieldValue not in bd => reset
            if (empty($masterFieldValue) or (!$model->existMasterField($masterFieldName,$masterFieldValue))) 
            {
                $masterFieldValue = "";
            }

            $slaveOptions = $model->getSlaveOptions($masterFieldName,$masterFieldValue,$slaveFieldName);
            $response = new JsonResponse($slaveOptions);
            echo $response;
        }
        catch(Exception $e)
        {
            echo new JsonResponse($e);
        }
    }
}
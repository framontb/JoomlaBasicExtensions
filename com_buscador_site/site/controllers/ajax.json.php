<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ramclasificado
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use \Joomla\CMS\Response\JsonResponse;

class Buscador_siteControllerAjax extends JControllerLegacy
{
    // Get the slave raw values from the database
    public function getSlaveValues()
    {
        try
        {
            # Get the model
            $model = $this->getModel('ajax');

            # master/slave field Variables
            $masterFieldName    = JFactory::getApplication()->input->get('masterFieldName','','STRING');        
            $slaveFieldName     = JFactory::getApplication()->input->get('slaveFieldName','','STRING');
            $masterFieldValue   = JFactory::getApplication()->input->get($masterFieldName,'','STRING');

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
            $masterFieldName    = JFactory::getApplication()->input->get('masterFieldName','','STRING');        
            $slaveFieldName     = JFactory::getApplication()->input->get('slaveFieldName','','STRING');
            $masterFieldValue   = JFactory::getApplication()->input->get($masterFieldName,'','STRING');

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
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
    public function getSlaveValues()
    {
        try
        {
            # Get the model
            $model = $this->getModel('ajax');

            # master/slave field Variables
            $masterFieldName    = 'profession';         
            $slaveFieldName     = JFactory::getApplication()->input->get('slaveFieldName','','WORD');
            $masterFieldValue   = JFactory::getApplication()->input->get($masterFieldName,'','WORD');

            # If empty $masterFieldValue, or $masterFieldValue not in bd => nothing to do
            if (empty($masterFieldValue) or (!$model->existMasterField($masterFieldName,$masterFieldValue))) 
            {
                $specialties = [];
            }
            # Otherwise => find slaveField
            else 
            {
                $specialties = $model->getSlaveValues($masterFieldName,$masterFieldValue,$slaveFieldName);
            }

            #$json = json_encode($specialties);
            $response = new JsonResponse($specialties);
            echo $response;
        }
        catch(Exception $e)
        {
            echo new JsonResponse($e);
        }
    }
}
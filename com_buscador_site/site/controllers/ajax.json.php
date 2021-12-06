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
    public function specialties()
    {
        try
        {
            # Get the model
            $model = $this->getModel('ajax');

            # master field Variables
            $masterFieldName    = 'profession';            
            $masterFieldValue   = JFactory::getApplication()->input->get($masterFieldName,'','WORD');
            $masterFieldTable   = '#__buscador_site_profession_list';

            # slave field Variables
            $slaveFieldName     = 'specialty';            
            $slaveFieldTable    = '#__buscador_site_profession_specialty_map';

            # If empty $masterFieldValue, or $masterFieldValue not in bd => nothing to do
            if (empty($masterFieldValue) or (!$model->existMasterField($masterFieldName,$masterFieldValue,$masterFieldTable))) 
            {
                $specialties = [];
            }
            # Otherwise => find slaveField
            else 
            {
                $specialties = $model->getSlaveFields($masterFieldName,$masterFieldValue,$slaveFieldName,$slaveFieldTable);
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
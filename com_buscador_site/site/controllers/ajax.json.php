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
    public function capitals()
    {
        try
        {
            $country = JFactory::getApplication()->input->get('country','UK',"WORD");

            if      ($country == 'UK')      $capital = 'London';
            elseif  ($country == 'Spain')   $capital = 'Madrid';
            else                            $capital = "I don't know";

            $capital_json = json_encode($capital);
            $response = new JsonResponse($capital_json);
            echo $response;
        }
        catch(Exception $e)
        {
            echo new JsonResponse($e);
        }
    }

    public function specialties()
    {
        try
        {
            # Variables
            $input_field        = 'profession';
            $default_value      = '';
            $field_validation   = "WORD";
            
            $profession = JFactory::getApplication()->input->get($input_field, $default_value, $field_validation);

            # Get the model
            $model = $this->getModel('ajax');

            # If empty $profession, or $profession not in bd => nothing to do
            if (empty($profession) or (!$model->existProfession($profession))) 
            {
                $specialties = [];
            }
            # Otherwise => find specialties
            else 
            {
                $specialties = $model->getSpecialtiesByProfession($profession);
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
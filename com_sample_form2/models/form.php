<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\FormModel;

class Sample_form2ModelForm extends FormModel
{

	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm(
			'com_sample_form2.sample',  // just a unique name to identify the form
			'sample_form',				// the filename of the XML form definition
										// Joomla will look in the models/forms folder for this file
			array(
				'control' => 'jform',	// the name of the array for the POST parameters
				'load_data' => $loadData	// will be TRUE
			)
		);

		if (empty($form))
		{
            $errors = $this->getErrors();
			throw new Exception(implode("\n", $errors), 500);
		}

		return $form;
	}

    protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			'com_sample_form2.sample',	// a unique name to identify the data in the session
			array("telephone" => "0")	// prefill data if no data found in session
		);

		return $data;
	}
	
}
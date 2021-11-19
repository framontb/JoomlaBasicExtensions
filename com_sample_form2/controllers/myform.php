<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;

class Sample_form2ControllerMyform extends BaseController
{   
	public function submit($key = null, $urlVar = null)
	{
		$this->checkToken();
		
		$app   = JFactory::getApplication();
		$model = $this->getModel('form');
		$form = $model->getForm($data, false);
		if (!$form)
		{
			$app->enqueueMessage($model->getError(), 'error');
			return false;
		}
		
		// name of array 'jform' must match 'control' => 'jform' line in the model code
		$data  = $this->input->post->get('jform', array(), 'array');
		
		// This is validate() from the FormModel class, not the Form class
		// FormModel::validate() calls both Form::filter() and Form::validate() methods
		$validData = $model->validate($form, $data);

		if ($validData === false)
		{
			$errors = $model->getErrors();

			foreach ($errors as $error)
			{
				if ($error instanceof \Exception)
				{
					$app->enqueueMessage($error->getMessage(), 'warning');
				}
				else
				{
					$app->enqueueMessage($error, 'warning');
				}
			}

			// Save the form data in the session, using a unique identifier
			$app->setUserState('com_sample_form2.sample', $data);
		}
		else
		{
			$app->enqueueMessage("Data successfully validated", 'notice');
			// Clear the form data in the session
			$app->setUserState('com_sample_form2.sample', null);
		}
		
		// Redirect back to the form in all cases
		$this->setRedirect(JRoute::_('index.php?option=com_sample_form2&view=form&layout=edit', false));
	}
}
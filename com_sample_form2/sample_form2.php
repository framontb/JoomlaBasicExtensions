<?php
defined('_JEXEC') or die('Restricted access');

// Load the appropriate controller class
$controller = JControllerLegacy::getInstance('Sample_form2');

$input = JFactory::getApplication()->input;
// Run the task method, or display() if no task parameter
$controller->execute($input->getCmd('task'));
 
$controller->redirect();
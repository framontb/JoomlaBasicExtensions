<?php
defined('_JEXEC') or die('Restricted access');

// Load the appropriate controller class
$controller = JControllerLegacy::getInstance('Ramajax');

$input = JFactory::getApplication()->input;
// Run the task method, or display() if no task parameter
$controller->execute($input->getCmd('task'));
 
$controller->redirect();
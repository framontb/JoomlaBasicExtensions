<?php
defined('_JEXEC') or die('Restricted access');

// Add Logger
// use Joomla\CMS\Log\Log;
// if (JDEBUG) {
//     JLog::addLogger(
//         array(
//             // Sets file name
//             'text_file' => 'com_ramajax.log.php'
//         ),
//         // Sets messages of all log levels to be sent to the file.
//         JLog::ALL,
//         // The log category/categories which should be recorded in this file.
//         // In this case, it's just the one category from our extension.
//         // We still need to put it inside an array.
//         array('com_ramajax')
//     );
//     JLog::add('*********** BEGIN COM_RAMAJAX **************', JLog::INFO, 'com_ramajax');
// }


// Load the appropriate controller class
$controller = JControllerLegacy::getInstance('Ramajax');

$input = JFactory::getApplication()->input;
// Run the task method, or display() if no task parameter
$controller->execute($input->getCmd('task'));
 
$controller->redirect();
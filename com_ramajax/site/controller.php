<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\BaseController;

class RamajaxController extends JControllerLegacy
{
    // Joomla will look for this class within the controller.php file
    // It will (usually) call the display() method, and will find this is in the BaseController class
    
    public function __construct()
    {
        $lang = JFactory::getLanguage();
        $extension = 'com_ramajaxuseexample';
        $base_dir = JPATH_SITE;
        $language_tag = 'en-GB';
        $reload = true;
        // $lang->load($extension, JPATH_ADMINISTRATOR, null,          false, true)
        $lang->load($extension, $base_dir,$language_tag, $reload);
    }
}
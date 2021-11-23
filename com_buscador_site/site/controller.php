<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\BaseController;

class Buscador_siteController extends JControllerLegacy
{
    // Joomla will look for this class within the controller.php file
    // It will (usually) call the display() method, and will find this is in the BaseController class

    /**
     * The default view for the display method.
     *
     * @var string
     * @since 12.2
     */
    protected $default_view = 'buscador';
}
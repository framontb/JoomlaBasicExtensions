<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HelloWorlds View
 *
 * @since  0.0.1
 */
class Buscador_siteViewBuscador extends JViewLegacy
{
    /**
     * Display the Buscador view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    function display($tpl = null)
    {
        // $context = "buscador_site.list.site.buscador_site";
        // Get data from the model
        $this->items		 = $this->get('Items');
        $this->pagination	 = $this->get('Pagination');
        $this->state         = $this->get('State');
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        // Display the template
        parent::display($tpl);

        // Set properties of the html document
        $this->setDocument();
    }

    /**
     * Method to set up the html document properties
     *
     * @return void
     */
    protected function setDocument() 
    {
        $document = JFactory::getDocument();
        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "/components/com_buscador_site"
                                          . "/views/buscador/buscador.js");
    }
}
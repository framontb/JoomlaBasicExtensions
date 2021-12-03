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
 * Ajax Model
 *
 * @since  0.0.1
 */
class Buscador_siteModelAjax extends JModelItem
{
    /**
     * Method to validate that a profession is in the table
     *
     * @param       string  $profession
     * @return      boolean  true if profession is in the table
     */
    public function existProfession(String $profession)
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('count(*)')
                ->from($db->quoteName('#__buscador_site','bs'))
                ->where($db->quoteName('profession') . " = " . $db->quote($profession));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $count = $db->loadResult();
        
        if ($count > 0) return True;
        else return False;
    }

    /**
     * Method to get all Specialties that match for a profession
     *
     * @param       string  $profession
     * @return      array   list of Specialties
     */
    public function getSpecialtiesByProfession(String $profession)
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        // https://docs.joomla.org/Selecting_data_using_JDatabase/es#loadColumn.28.29
        $query->select('DISTINCT specialty')
                ->from($db->quoteName('#__buscador_site','bs'))
                ->where($db->quoteName('profession') . " = " . $db->quote($profession));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $column= $db->loadColumn();
        
        return $column;
    }
    
}
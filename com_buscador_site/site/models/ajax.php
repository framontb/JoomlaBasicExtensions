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
    public array $masterTable;
    public array $slaveTable;

    public function __construct()
    {
        # Master Field tables
        $this->masterTable['profession'] = '#__buscador_site_profession_list';

        # Slave Field tables
        $this->slaveTable['specialty'] = '#__buscador_site_profession_specialty_map';

        parent::__construct();
    }

    public function getMasterTable(String $masterFieldName)
    {
        try {
            return $this->masterTable[$masterFieldName];
        }
		catch (Exception $e)
		{
			throw new Exception(implode("ERROR_MASTER_TABLE\n", $e->getCode(), $e->getMessage()), 500);
		}
    }

    public function getSlaveTable(String $slaveFieldName)
    {
        try {
            return $this->slaveTable[$slaveFieldName];
        }
		catch (Exception $e)
		{
			throw new Exception(implode("ERROR_SLAVE_TABLE\n", $e->getCode(), $e->getMessage()), 500);
		}
    }

    /**
     * Method to validate that a masterField is in the table
     *
     * @param       string  $masterField
     * @return      boolean  true if masterField is in the table
     */
    public function existMasterField(String $masterFieldName, String $masterFieldValue)
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $masterFieldTable = $this->getMasterTable($masterFieldName);

        // Create the base select statement.
        $query->select('count(*)')
                ->from($db->quoteName($masterFieldTable))
                ->where($db->quoteName($masterFieldName) . " = " . $db->quote($masterFieldValue));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $count = $db->loadResult();
        
        if ($count > 0) return True;
        else return False;
    }

    /**
     * Method to get all slave Fields that match for a masterField
     *
     * @param       string  $masterField
     * @return      array   list of Slave Values
     */
    public function getSlaveValues(
        String $masterFieldName,
        String $masterFieldValue,
        String $slaveFieldName)
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $slaveFieldTable = $this->getSlaveTable($slaveFieldName);

        // Create the base select statement.
        // https://docs.joomla.org/Selecting_data_using_JDatabase/es#loadColumn.28.29
        $query->select($slaveFieldName)
                ->from($db->quoteName($slaveFieldTable))
                ->where($db->quoteName($masterFieldName) . " = " . $db->quote($masterFieldValue));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $column= $db->loadColumn();
        
        return $column;
    }

    /**
     * Method to get the slave message when the primary is empty
     * 
     * It will be assigned no value in getSlaveOptions, so it matches for All specialties
     *
     * @param       string  $masterField
     * @return      array   list of Slave Values
     */
    public function getSlaveEmptyValue(String $masterFieldName,String $slaveFieldName)
    {
        // Initialize variables.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $slaveFieldTable = $this->getSlaveTable($slaveFieldName);

        $query->select($slaveFieldName)
                ->from($db->quoteName($slaveFieldTable))
                ->where($db->quoteName($masterFieldName) . " = ''");

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $result= $db->loadResult();
        
        return $result;
    }

    /**
     * Method to get all slave Options that match for a masterField
     *
     * @param       string  $masterField
     * @return      array   list of Slave Values
     */
    public function getSlaveOptions(
        String $masterFieldName,
        String $masterFieldValue,
        String $slaveFieldName,
        String $slaveFieldValue='')
    {
        // Get default Option
        $slaveEmpty   = $this->getSlaveEmptyValue($masterFieldName,$slaveFieldName);
        $options  = '<option value>'.JText::_($slaveEmpty).'</option>';

        // Get the other Options
        if ($this->existMasterField($masterFieldName,$masterFieldValue)){
            $slavesFromDb = $this->getSlaveValues($masterFieldName,$masterFieldValue,$slaveFieldName);
            foreach ($slavesFromDb as $slaveDb) 
            {
                $selected = ($slaveFieldValue ==  $slaveDb)?'selected="selected"':'';
                $slaveDbTranslated = JText::_($slaveDb);
                $options .= "<option value='$slaveDb' $selected>$slaveDbTranslated</option>";
            }
        }

        return $options;
    }
}
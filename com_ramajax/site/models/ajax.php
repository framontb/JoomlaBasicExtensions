<?php
/**
 * Ramajax
 * @version      $Id$
 * @package      ramajax
 * @copyright    Copyright (C) 2021 framontb. All rights reserved.
 * @license      GNU/GPL
 * @link         https://github.com/framontb/JoomlaBasicExtensions
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Ajax Model
 *
 * @since  0.0.1
 */
class RamajaxModelAjax extends JModelItem
{
    public function getFieldTable(String $FieldName)
    {
        try {
            $db    = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select($db->quoteName('table'))
                ->from($db->quoteName('#__ramajax_field_tables'))
                ->where($db->quoteName('field') . " = " . $db->quote($FieldName));
            
                // Reset the query using our newly populated query object.
            $db->setQuery($query);
            $tableDb    = $db->loadResult();
            return $tableDb;
        }
        catch (Exception $e)
        {
            throw new Exception(implode("ERROR_TABLE\n", $e->getCode(), $e->getMessage()), 500);
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
        $masterFieldTable = $this->getFieldTable($masterFieldName);

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
        $slaveFieldTable = $this->getFieldTable($slaveFieldName);

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
        $slaveFieldTable = $this->getFieldTable($slaveFieldName);

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
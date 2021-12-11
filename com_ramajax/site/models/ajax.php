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
    /**
     * Buffer for Ramajax definition data
     *  [
     *      name                = "player" 
     *      type                = "ramajax" 
     *      masterFieldName     = "team"
     *      masterFieldTable    = "#__ramajax_league_team_map"
     *      slaveFieldName      = "player"
     *      slaveFieldTable     = "#__ramajax_use_example"
	 *   ]
     */
    public array $ramajaxDefinition;

    public $existMasterField;

    // Constructor
    public function __construct($properties = null) 
    {
        $this->ramajaxDefinition = array();
        $this->existMasterField = null;

        parent::__construct($properties);
    }

    /**
     * Gets the Ramajax definition from DB or Buffer Property
     * 
     * Buffering data (in $this->ramajaxDefinition) saves queries to DB
     */
    public function getRamajaxDefinition(String $ramajaxName)
    {
        if (empty($this->ramajaxDefinition))
        {
            $db    = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                ->from($db->quoteName('#__ramajax_definition_tables'))
                ->where($db->quoteName('name') . " = " . $db->quote($ramajaxName));
            $db->setQuery($query);
            $this->ramajaxDefinition  = $db->loadAssoc();
        }

        return $this->ramajaxDefinition ;
    }

    /**
     * Method to validate that a masterField is in the table
     *
     * @param       string  $masterField
     * @return      boolean  true if masterField is in the table
     */
    public function existMasterField(String $ramajaxName, String $masterFieldValue)
    {
        // Initialize variables.
        $ramdef  = $this->getRamajaxDefinition($ramajaxName);

        // Create the base select statement.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('count(*)')
                ->from($db->quoteName($ramdef['masterFieldTable']))
                ->where($db->quoteName($ramdef['masterFieldName']) . " = " . $db->quote($masterFieldValue));

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $count = $db->loadResult();

        if ($count > 0) $this->existMasterField = True;
        else $this->existMasterField =  False;


        return $this->existMasterField;
    }

    /**
     * Method to get all slave Fields that match for a masterField
     *
     * @param       string  $masterField
     * @return      array   list of Slave Values
     */
    public function getSlaveValues(
        String $ramajaxName,
        String $masterFieldValue)
    {
        // Get Ramajax definition
        $ramdef  = $this->getRamajaxDefinition($ramajaxName);

        // Create the base select statement.
        // https://docs.joomla.org/Selecting_data_using_JDatabase/es#loadColumn.28.29
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($ramdef['slaveFieldName'])
                ->from($db->quoteName($ramdef['slaveFieldTable']))
                ->where($db->quoteName($ramdef['masterFieldName']) . " = " . $db->quote($masterFieldValue));

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
    public function getSlaveEmptyValue(String $ramajaxName)
    {
        // Initialize variables.
        $ramdef  = $this->getRamajaxDefinition($ramajaxName);

        // DB query
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select($ramdef['slaveFieldName'])
                ->from($db->quoteName($ramdef['slaveFieldTable']))
                ->where($db->quoteName($ramdef['masterFieldName']) . " = ''");
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
        String $ramajaxName,
        String $masterFieldValue,
        String $slaveFieldValue='')
    {
        // Initialize variables.
        $ramdef  = $this->getRamajaxDefinition($ramajaxName);

        // Get default Option
        $slaveEmpty   = $this->getSlaveEmptyValue($ramajaxName);
        $options  = '<option value>'.JText::_($slaveEmpty).'</option>';

        // Get the other Options
        if ($this->existMasterField($ramajaxName,$masterFieldValue)){
            $slavesFromDb = $this->getSlaveValues($ramajaxName,$masterFieldValue);
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
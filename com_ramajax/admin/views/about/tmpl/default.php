<?php
/**
 * Ramajax
 * @version      $Id$
 * @package      ramajax
 * @copyright    Copyright (C) 2021 framontb. All rights reserved.
 * @license      GNU/GPL
 * @link         https://github.com/framontb/JoomlaBasicExtensions
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

// Get URI root
$uri = JUri::getInstance();
$uriRoot =  $uri->root();

?>

<style>
.ram {
  width: 50%;
}

</style>

<div class="ram">
    <h2>Features</h2>
    <p>
        This utility makes life easy for developers 
        who wants to set up dynamic combo selects in his views.

        This component creates ajax responses to update the options of select html elements.

        Furthermore, it implements a new field type (JFormFieldRamajax) 
        to create the "slave" select.
    </p>

    <h2>Check if Ramajax is working</h2>

    <p>
    Ramajax component comes with some data configured, so you can check if it is working.
    </br>You can access this URL to check if the ajax server is working: 
    <a target="_blank" href="<?php echo $uriRoot ?>index.php?option=com_ramajax&task=ajax.getSlaveValues&format=json&masterFieldName=league&slaveFieldName=team&league=NBA">CHECK AJAX</a>
    </p>

    <p> You should see a text like this in your browser:
    <xmp>
    {"success":true,"message":null,"messages":null,"data":["Phoenix Suns","Los Angeles Lakers","Golden State Warriors"]}
    </xmp>
    </p>

    <h2>How to use it</h2>
    <p>
        After intall com_ramajax, and check it's working properly, you will need:
        <ol>
            <li>two tables in the database with the information for the selects (see the example tables in this component)</li>
            <li>modify the model to include your tables (/site/models/ajax.php).
                You will need to add two lines to the RamajaxModelAjax->__construct, with the pair fieldName/Table.
            </li>
            <li>add two fields to your Form (the main field and the slave field). 
                The main select with type <b>sql</b> 
                and the slave of type <b>ramajax</b></li>
            <li>declare the javascript <b>/assets/js/ramajax.js</b> in your view</li>
            <li>add a tiny <b>js</b> script to your view to invoque the ajax call 
            on change event of main field</li>
        </ol>
    </p>

    <h2>See it in the component example</h2>
    <p>Example: com_ramajax_example</p>

    <h2>How to improve the component</h2>
    <ul>
        <li>Add a table to avoid hardconding info in the model</li>
        <li>Add a Form to add new pairs of master-slave combo selects</li>
        <li>Add more javascript and FormFields for new html elements</li>
    </ul>

</div>
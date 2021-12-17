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

<h2>How it works</h2>
    <p>Explain the code</p>

<h2>Check if Ramajax is working</h2>

    <p>
    Ramajax component comes with some data configured, so you can check if it is working.
    </br>You can access this URL to check if the ajax server is working: 
    <a target="_blank" href="<?php echo $uriRoot ?>index.php?option=com_ramajax&task=ajax.getSlaveValues&format=json&ramajaxName=team&masterFieldValue=NBA">CHECK AJAX</a>
    </p>

    <p> You should see a text like this in your browser:
    <xmp>
    {
        "success":true,
        "message":null,
        "messages":null,
        "data":[
            "Phoenix Suns",
            "Los Angeles Lakers",
            "Golden State Warriors"
            ]
    }
    </xmp>
    </p>

<h2>How to use it</h2>
    <p>
        After install com_ramajax, and check it's working properly, you will need:
        <ol>
            <li>add two fields to your Form (the main field and the slave field). 
                The main select with type <b>sql</b> 
                and the slave of type <b>ramajax</b></li>
            <li>be sure <b>jQuery</b> is in your view</li>
            <li>declare the javascript <b>/assets/js/ramajax.js</b> in your view</li>
            <li>add a tiny <b>js</b> script to your view to invoque the ajax call 
            on change event of main field</li>
        </ol>
    </p>

<h2>See it in the component example</h2>
    <p>Example: com_ramajax_example</p>

<h2>How to improve the component</h2>
    <ul>
        <li>Add an Options Form to add new pairs of master-slave combo selects (ramajax field)</li>
        <li>Add more javascript and FormFields for new html elements (check boxes)</li>
        <li>Add translations<li>
    </ul>

<h2>Troubleshooting</h2>
    <ul>
        <li>Activating "Global Configuration > System > Debug System = YES" will leave logs in the file: "/var/www/html/administrator/logs/com_ramajax.log.php"</li>
        <li>You can add more logs easily, just watch the site entry poing for the com_ramajax.</li>
    </ul>

<h2>TODO</h2>
    <ul>
        <li>Error managing for ajax. For example, conflict between ramajax fields access to db.</li>
        <li>Translations</li>
        <li>Translations: field sql type origin</li>
        <li>Translations: Translate to language different from english</li>
        <li>Translations: what is a multilanguage page for joomla</li>
        <li>Check token in controller</li>
        <li>Repasar notas de copyright</li>
        <li>Check if in the Example's view, puttin $this->setDocument before display, loads the javascript so I can use it in the 
            ramajax field
        </li>
        <li>Add new ramajax field example with an alternative select player more restrictive</li>
        <li>Add new ramajax field example the fourth chained one for wage</li>

    </ul>

    <h2>DONE</h2>
    <ul>
        <li>First time a ramajax field loads, it saves the tables in __ramajax_field_tables</li>
        <li>error managing for ramajax field auto-provision</li>
        <li>BUG: When using the pagination links with league selected, the team select doesn't fill values.
            Si el master field presenta un valor, deben cargarse las opciones correspondientes en el slave.
            Reproducir: Selecciona una liga, y submit. Luego pica en link de paginación. El select de team no tiene valores,
            aunque hay una liga elegida.
        </li>
    </ul>

</div>
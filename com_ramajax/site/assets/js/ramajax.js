// /**
//  * Ramajax
//  * @version      $Id$
//  * @package      ramajax
//  * @copyright    Copyright (C) 2021 framontb. All rights reserved.
//  * @license      GNU/GPL
//  * @link         https://github.com/framontb/JoomlaBasicExtensions
//  */

// Populates the indicated slave select (see slaveSelectId in the event)
// with options directly received from ajax request
// Observe here task=ajax.getSlaveOptions
function populateSlaveSelectFromOptions(event)
{
    // alert(event.data.mainFieldName);
    var mainFieldValue = jQuery(this).find(':selected').val();
    dataString  = '&masterFieldName='+event.data.mainFieldName
    dataString += '&slaveFieldName='+event.data.slaveFieldName
    dataString += "&"+event.data.mainFieldName+"=" + mainFieldValue;

    jQuery.ajax({
        type     : 'GET',
        url      : 'index.php?option=com_ramajax&task=ajax.getSlaveOptions&format=json',
        data     : dataString,
        dataType : 'JSON',
        cache    : true,
        success  : function(data) {
            jQuery(event.data.slaveSelectId).empty().append(data.data);
        },
        error    : function(){console.log("Ajax failed");}
    }); 
}

// Populates the indicated slave select (see slaveSelectId in the event)
// creating the options from the values received from ajax request.
// This function gets the raw data from the database,
// and leaves the responsability of constructing the Options
// to the JavaScript.
// Note that there is no translate for options created from scratch,
// Like "All" example
function populateSlaveSelectFromValues(event)
{

    // alert(event.data.mainFieldName);
    var mainFieldValue = jQuery(this).find(':selected').val();
    dataString  = '&masterFieldName='+event.data.mainFieldName
    dataString += '&slaveFieldName='+event.data.slaveFieldName
    dataString += "&"+event.data.mainFieldName+"=" + mainFieldValue;

    // alert(dataString);

    jQuery.ajax({
        type     : 'GET',
        url      : 'index.php?option=com_ramajax&task=ajax.getSlaveValues&format=json',
        data     : dataString,
        dataType : 'JSON',
        cache    : true,
        success  : function(data) {            
            var output = '<option value>All</option>';
            jQuery.each(data.data, function(i,s){
                var newOption = s;

                output += '<option value="' + newOption + '">' + newOption + '</option>';
            });

            jQuery(event.data.slaveSelectId).empty().append(output);
        },
        error: function(){
            console.log("Ajax failed");
        }
    }); 
}
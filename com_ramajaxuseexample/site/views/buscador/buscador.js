jQuery(document).ready(function() {
    jQuery('#filter_league').change(
        {
            mainFieldName:"league",
            slaveFieldName:"team",
            slaveSelectId:"#filter_team"
        }, 
        populateSlaveSelectFromOptions);
});

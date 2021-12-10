jQuery(document).ready(function() {
    jQuery('#filter_league').change(
        {
            mainFieldName:"league",
            slaveFieldName:"team",
            slaveSelectId:"#filter_team"
        }, 
        populateSlaveSelectFromOptions);

    jQuery('#filter_team').change(
        {
            mainFieldName:"team",
            slaveFieldName:"player",
            slaveSelectId:"#filter_player"
        }, 
        populateSlaveSelectFromOptions);
});

jQuery(document).ready(function() {

    // ajax request for team
    jQuery('#filter_league').change(
        {
            mainFieldName:"league",
            slaveFieldName:"team",
            slaveSelectId:"#filter_team"
        }, 
        populateSlaveSelectFromOptions);

    // ajax request for player
    jQuery('#filter_team').change(
        {
            mainFieldName:"team",
            slaveFieldName:"player",
            slaveSelectId:"#filter_player"
        }, 
        populateSlaveSelectFromOptions);

    // reset button
    jQuery('#filter_clear').click(filter_clear);

    // Reset function
    // Because changes cascade, we only need to reset the first element of the chain
    function filter_clear() 
    {
        jQuery('#filter_league').val("").change();
    }
});

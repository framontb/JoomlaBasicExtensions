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
    function filter_clear() 
    {
        jQuery('#filter_team').empty().append('<option value>ALL</option>');
        jQuery('#filter_player').empty().append('<option value>ALL</option>');
    }
});

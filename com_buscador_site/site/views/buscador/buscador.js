jQuery(document).ready(function() {
    jQuery('#filter_profession').change({mainFieldName:"profession"}, populateSelectSpecialties);
    jQuery('#filter_clear').click(filter_clear);

    // Reset button
    function filter_clear() 
    {
        jQuery('#filter_search').attr('value','');
        jQuery('#filter_profession').attr('value','');
        jQuery('#filter_specialty').empty().append('<option value>All</option>');
    }

    // Ajax for Specialties
    function populateSelectSpecialties(event)
    {

        // alert(event.data.mainFieldName);
        var mainFieldValue = jQuery(this).find(':selected').val(),
        dataString = "&"+event.data.mainFieldName+"=" + mainFieldValue;
        // alert(dataString);
        if(mainFieldValue != '')
        {
            jQuery.ajax({
                type     : 'GET',
                url      : 'index.php?option=com_buscador_site&task=ajax.specialties&format=json',
                data     : dataString,
                dataType : 'JSON',
                cache    : true,
                success  : function(data) {            
                    var output = '<option value>All</option>';
                    jQuery.each(data.data, function(i,s){
                        var newOption = s;
    
                        output += '<option value="' + newOption + '">' + newOption + '</option>';
                    });
    
                    jQuery('#filter_specialty').empty().append(output);
                },
                error: function(){
                    console.log("Ajax failed");
                }
            }); 
        }
        else
        {
            console.log("You have to select at least sth");
            jQuery('#filter_specialty').empty().append('<option value>All</option>');
        }
    }
});
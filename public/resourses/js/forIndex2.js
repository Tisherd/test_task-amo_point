$('select[name="type_val"]').on('change', function() {
    let selectOption = $('select[name="type_val"]').val();
    $( "input" ).each(function( element ) {
        if ($( this ).attr('name').includes(selectOption)) {
            $( this ).parent().show();
        } else {
            $( this ).parent().hide();
        }
      });
});
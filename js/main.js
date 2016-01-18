jQuery(function($) {
    $(document).on('click', '.overlay', function() {
        document.location.href = '#';
    }).keyup(function(e) {
        if (e.keyCode == 27) {
            document.location.href = '#';
        }
    });
});
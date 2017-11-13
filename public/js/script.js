'use strict';

jQuery(document).ready(function () {
    $('[data-toggle=confirmation]').click(
        function(e) {
            e.preventDefault();
            
            alertify.confirm($(this).data('data-title'), 'Confirm Message', function() {
                alertify.success('OK');
                obj.submit();
            }, function() {
                alertify.error('Cancel');
            });
    });
});
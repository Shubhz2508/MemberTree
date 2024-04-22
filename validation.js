// validation.js

(function($) {
    $(document).ready(function() {
        $('#addMemberForm').submit(function(event) {
            var name = $('#name').val();
            if (!/^[A-Za-z\s]+$/.test(name)) {
                $('#name').addClass('is-invalid');
                event.preventDefault();
            } else {
                $('#name').removeClass('is-invalid');
            }
        });
    });
})(jQuery);

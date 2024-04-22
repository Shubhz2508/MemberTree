// saveData.js

(function($) {
    $(document).ready(function() {
        $('#saveChangesBtn').click(function() {
            // Validate the form
            if ($('#addMemberForm')[0].checkValidity()) {
                // If form is valid, submit the form using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'save_data.php', // URL to handle form submission
                    data: $('#addMemberForm').serialize(),
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        // You can display a success message or perform any other action here
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        // You can display an error message or perform any other action here
                    }
                });
            } else {
                // If form is invalid, prevent default form submission
                $('#addMemberForm')[0].reportValidity();
            }
        });
    });
})(jQuery);

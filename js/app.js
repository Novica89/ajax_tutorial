$(document).ready(function() {
    $('#create-task-form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        $('.validation-errors').hide();
        $('.task-added-message').hide();

        // send the AJAX request to submit this form
        var createTask = $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            method: 'POST'
        });

        // if request was successfull
        createTask.done(function(data) {
            var response = JSON.parse(data);
            $('.task-added-message').text(response.message).slideDown();
            form.find('#title').val('');
            form.find('#description').val('');
        });

        // if request failed
        createTask.fail(function(data) {
            var response = JSON.parse(data.responseText);
            $('.validation-errors').text(response.message).slideDown();
            console.log(response.message);
        });

    })
});

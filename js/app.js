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

            appendNewTask(response.resource);

        });

        // if request failed
        createTask.fail(function(data) {
            var response = JSON.parse(data.responseText);
            $('.validation-errors').text(response.message).slideDown();
        });

    });

    $('.task-list').on('click', '.finish-task', function(e) {
        e.preventDefault();
        var finishTaskLink = $(this);

        var finishTask = $.ajax({
            url: finishTaskLink.attr('href'),
            method: 'GET'
        });

        finishTask.done(function(data) {
            var response = JSON.parse(data);
            $('.task-added-message').text(response.message).slideDown();

            removeFinishedTask(response.resource);
        });
    });

    function appendNewTask(task) {
        /*
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $task['title']; ?></h5>
                <p class="card-text"><?php echo $task['description']; ?></p>
                <a href="finish_task.php?position=<?php echo $index ?>" class="btn btn-primary">Finished</a>
            </div>
        </div>
        */

        var card = $('<div></div>').addClass('card').attr('id', 'task-' + task.id),
            cardBody = $('<div></div>').addClass('card-body'),
            title = $('<h5></h5>').addClass('card-title').text(task.title),
            description = $('<p></p>').addClass('card-text').text(task.description),
            action = $('<a></a>').attr('href', 'finish_task.php?position=' + task.id).addClass('btn btn-primary finish-task').text('Finished');

        var newTaskElement = card.append(cardBody.append(title).append(description).append(action));
        $('.task-list').append(newTaskElement);
    }

    function removeFinishedTask(task) {
        $('#task-' + task.id).slideUp();
    }

});

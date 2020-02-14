<?php
session_start();

if (!is_ajax()) {
    throw new Exception('Uh oh... AJAX requests only!');
}

/* Process the form for creating a new task */
if (inputValid('title') && inputValid('description')) {
    // all good, we're gonna create new Task
    $new_task = [
        'id'            => count($_SESSION['tasks']),
        'title'         => $_POST['title'],
        'description'   => $_POST['description']
    ];

    $_SESSION['tasks'][] = $new_task;

} else {
    // input not valid, return error
    http_response_code(403);
    echo json_encode([
        'status' => 'error',
        'message' => 'You must fill in both, title and description to add a task'
    ]);
    die;
}

http_response_code(200);
echo json_encode([
    'status' => 'success',
    'message' => 'Task has been created',
    'resource' => $new_task
]);


function inputValid($input_name) {
    return isset($_POST[$input_name]) && ! empty($_POST[$input_name]);
}

//Function to check if the request is an AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


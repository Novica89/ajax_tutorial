<?php
session_start();
/* Process the form for creating a new task */
if (inputValid('position')) {

    $finished_task = $_SESSION['tasks'][$_GET['position']];

    // all good, we're gonna remove a specific task
    unset($_SESSION['tasks'][$_GET['position']]);

} else {
    header('Location: http://ajax_tutorial.test/');
    exit;
}

http_response_code(200);
echo json_encode([
    'status' => 'success',
    'message' => 'Task has been marked as finished',
    'resource' => $finished_task
]);

function inputValid($input_name) {
    return isset($_GET[$input_name]) && isset($_SESSION['tasks'][$_GET['position']]);
}


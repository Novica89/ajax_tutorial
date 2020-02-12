<?php
session_start();
/* Process the form for creating a new task */
if (inputValid('title') && inputValid('description')) {
    // all good, we're gonna create new Task
    $_SESSION['tasks'][] = [
        'title'         => $_POST['title'],
        'description'   => $_POST['description']
    ];

} else {
    header('Location: http://ajax_tutorial.test/');
    exit;
}

function inputValid($input_name) {
    return isset($_POST[$input_name]) && ! empty($_POST[$input_name]);
}

/* Redirect back to our application front */
header('Location: http://ajax_tutorial.test/');
exit;

<?php
session_start();
/* Process the form for creating a new task */
if (inputValid('position')) {
    // all good, we're gonna remove a specific task
    unset($_SESSION['tasks'][$_GET['position']]);

} else {
    header('Location: http://ajax_tutorial.test/');
    exit;
}

function inputValid($input_name) {
    return isset($_GET[$input_name]) && isset($_SESSION['tasks'][$_GET['position']]);
}

/* Redirect back to our application front */
header('Location: http://ajax_tutorial.test/');
exit;

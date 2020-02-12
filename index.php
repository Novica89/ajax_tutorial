<?php
session_start();
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <title>Tasker</title>
</head>
<body>
<div class="jumbotron">
    <h1>Tasker</h1>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-xs-10 offset-xs-1 mb-2">
                <h2>Create Task</h2>
                <form action="add_task.php" method="POST">
                    <div class="form-group">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description">Description</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary"> Create</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-xs-10 offset-xs-1">
                <h2>Existing Tasks</h2>
                <?php foreach($_SESSION['tasks'] as $index => $task): ?>
                    <div class="card">
                        <!--                        <img class="card-img-top" src="..." alt="Card image cap">-->
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $task['title']; ?></h5>
                            <p class="card-text"><?php echo $task['description']; ?></p>
                            <a href="finish_task.php?position=<?php echo $index ?>" class="btn btn-primary">Finished</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

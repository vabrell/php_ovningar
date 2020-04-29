<?php

session_start();

require 'Todos.php';

$TODOS = new Todos;

if (isset($_POST['add'])) {
    $TODOS->store($_POST['task']);
}

if (isset($_GET['action']) && $_GET['action'] === 'complete') {
    $TODOS->update($_GET['todo']);
}

$todos = $TODOS->get();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c253d5ef44.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            padding-top: 2rem;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        #add_tasks {
            display: grid;
            grid-template-columns: 80% 20%;
        }

        #add_tasks>input[type=text] {
            border: none;
            border-bottom: 4px solid rgb(55, 115, 183);
            border-top: 4px solid rgb(55, 115, 183);
            border-left: 4px solid rgb(55, 115, 183);
            color: rgb(55, 115, 183);
            padding: .5rem .5rem .5rem 1rem;
            font-size: 1rem;
        }

        #add_tasks>input[type=submit] {
            background-color: rgb(55, 115, 183);
            color: rgb(255, 255, 255);
            font-size: 1rem;
            border: none;
            font-weight: bold;
        }

        .todo {
            display: grid;
            grid-template-columns: 80% 20%;
            align-items: center;
            background-color: rgba(55, 115, 183, 0.9);
            color: rgb(255, 255, 255);
            font-size: 1.5rem;
        }

        .todo>p {
            padding-left: 1rem;
        }

        .todo>p.completed {
            text-decoration: line-through;
            font-style: italic;
        }

        .todo>a {
            justify-self: center;
            color: rgb(255, 255, 255);
        }

        .todo>i {
            justify-self: center;
            color: rgba(0, 255, 0, .5);
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" id="add_tasks">
            <input type="text" name="task" placeholder="Ny uppgift...">
            <input type="submit" name="add" value="Lägg till">
        </form>
    </div>
    <div class="container">
        <?php foreach ($todos as $index => $todo) { ?>
            <div class="todo">
                <p class="<?php echo $todo->completed === true ? 'completed' : '' ?>"><?php echo $todo->task ?></p>
                <?php if ($todo->completed) { ?>
                    <i class="far fa-check-circle"></i>
                <?php } else { ?>
                    <a href="?action=complete&todo=<?php echo $index ?>">
                        <i class="far fa-circle"></i>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>

</html>
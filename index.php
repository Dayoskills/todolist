<?php
$errors = "";

// create connection to db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = mysqli_connect ($servername, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task'); ";
    if (empty ($task)) {
        $errors = "You must fill in the task";
    } else {
    mysqli_query ($conn, $sql);
    header("location: index.php");
    }    
}

// delete task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    $sql3 = "DELETE FROM tasks WHERE id= $id";
    mysqli_query ($conn, $sql3); 
    header("location: index.php");
}

$sql2 = "SELECT * FROM tasks";
$tasks = mysqli_query ($conn, $sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=  , initial-scale=1.0">
    <title>Todo List Application with PHP and MySQL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="heading"> 
        <h2>Todo List Application with PHP and MySQL</h2>
    </div>

    <form action="index.php" method="POST">
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p> 
    <?php    } ?>
        
        <input type="text" name="task" class="task_input">
        <button type="submit" name="submit" class="task_btn">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>   
                <td><?php echo $i; ?></td>
                <td class= "task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
                </td>
            </tr>

        <?php $i++; } ?>  
            
        
        </tbody>
    </table>


</body>
</html>
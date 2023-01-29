<?php
include('connection.php');
$errors = "";

// insert into database
if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    
    if (empty ($task)) {
    $errors = "You must fill in the task";
    return;
    } else {
        $sql = "INSERT INTO tasks (task) VALUES ('$task'); ";   
        mysqli_query ($conn, $sql);
        header("location: index.php");
    }    
} 

// delete task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    $sql2 = "DELETE FROM tasks WHERE id= $id";
    mysqli_query ($conn, $sql2); 
    header("location: index.php");
}

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
        <?php 
            // select from database
            $sql3 = "SELECT * FROM tasks";
            $result = mysqli_query ($conn, $sql3);
            $count = 1; while ($row = mysqli_fetch_array($result)) { ?>
            
            <tr>   
                <td><?php echo $count; ?></td>
                <td class= "task"><?php echo $row['task']; ?></td>
                
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">Delete</a> 
                    |
                    <a href="edit.php?id=<?php echo $row['id']; ?>" type = "button">Edit</a> 
                </td>   
            </tr>

        <?php $count++; } ?>  
    
        </tbody>
    </table>

</body>
</html>
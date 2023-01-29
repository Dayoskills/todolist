<?php
include('connection.php');

if (isset($_GET['id']) && $_GET['id'] != '' ) {
// Get submitted form  
$id = $_GET['id'];

// update
if (isset($_POST['update'])) {

// Get submitted form    
    $id = $_POST['id'];
    $task_name = $_POST['task_name'];
   
    // check if task is empty.
        if (empty ($task_name)) {
            $errors = "You must fill in the task";
        
        } else {
        // update query 
        $sql4 = "UPDATE tasks SET task= '$task_name' WHERE id= '$id';";  
        mysqli_query ($conn, $sql4);
    
        if (mysqli_query($conn, $sql4) === TRUE) {
        echo "Task Updated Successfully";
        } else {
            "Error Updating task: " . $sql4. "<br>" . mysqli_error($conn);
        }
        header("location: index.php");
        }    
    }
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

    <form action="" method= "POST">
    <?php if (isset($errors)) { ?>
        <p><?php echo $errors; ?></p> 
        <?php } ?>
        <input type="text" name="task_name" class="task_input" placeholder= "Enter task name ...">
        <br>
        <input type="hidden" name="id" value = "<?php echo $id; ?>" >
        <br>
        <button type="submit" name="update" class="task_btn">Update Task</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Back</a>
    </form>


</body>
</html>
  
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

$conn = mysqli_connect ($servername, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task'); ";

    mysqli_query ($conn, $sql);
    header("location: index.php");
}

?>
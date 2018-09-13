<?php

$makosa = "";

//connect to the DB

$con = mysqli_connect('localhost', 'root', '', 'todo');

if (isset($_POST['submit'])){
    $task = mysqli_real_escape_string($con, $_POST['task']);
    if (empty($task)){
        $makosa = "You cannot submit an Empty task";
    }
    else{
        $insert = "INSERT INTO `activities`(`task`) VALUES ('$task')";
        $query = mysqli_query($con, $insert);

        header('location: list.php');

    }

}

// delete task
if (isset($_GET['del_task'])) {
    $id = mysqli_real_escape_string($con, $_GET['del_task']);
    mysqli_query($con, "DELETE FROM `activities` WHERE id=$id");
    header('location:list.php');
}

   $task= mysqli_query($con, "SELECT * FROM `activities`");

?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="heading ">
    <h2>Todo List Application</h2>
</div>

<form method="POST" action="list.php">

    <?php if (isset($makosa)) {?>

        <p class="makosa"><?php echo $makosa; ?></p>
        
    <?php } ?>

    <input type="text" name="task" class="task_input">
    <button type="submit" class="task_btn" name="submit">Add Task</button>
</form>


<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Task To Do</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

        <?php $number= 1;  while ($row = mysqli_fetch_array($task)) { ?>

                 <tr>
        <td> <?php echo $number; ?> </td>
        <td class="task"> <?php echo $row['task']; ?> </td>
        <td class="delete">
            <a href="list.php?del_task=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
            
        <?php $number++; } ?>


    </tbody>
</table>

</body>
</html>
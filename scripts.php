<?php
//INCLUDE DATABASE FILE
include('database.php');

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();
// if (isset($_POST['id'])) {
//     var_dump($_POST);
//     die();
// }
//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();

function getTasks($status)
{
    global $conn;
    $sql = "SELECT
        ta.id as id ,
        ta.title as title ,
        ty.name as type,
        s.name as status,
        s.id as id_status,
        p.name as priority,
        p.id as id_priority,
        ta.task_datetime as date,
        ta.description as description
    FROM
        tasks as ta ,
        priorities as p ,
        statuses as s ,
        types as ty
    WHERE
        ta.type_id = ty.id
    and 
        ta.status_id = s.id
    and 
        ta.priority_id = p.id
    and 
        s.name= '$status'";

    $res = $conn->query($sql);
    return $res;
}

function saveTask()
{
    extract($_POST);

    global $conn;
    $sql = "INSERT INTO tasks (title, type_id, status_id, priority_id, task_datetime , description)
            values ('$title', '$type', '$status', '$priority', '$date','$description')";
    $res = $conn->query($sql);
    if ($res) {
        $_SESSION['message'] = "Task has been added successfully !";
        header('location: index.php');
    }
}

function updateTask()
{
    extract($_POST);
    global $conn;
    $sql = "UPDATE tasks SET title ='$title',type_id=$type, priority_id=$priority,status_id=$status,task_datetime='$date',description='$description' WHERE id=$id";
    $res = $conn->query($sql);
    if ($res) {
        $_SESSION['message'] = "Task has been updated successfully !";
    } else {
        $_SESSION['message'] = "Error!";
    }
    header('location: index.php');
}

function getPriorities()
{
    global $conn;
    $sql = "SELECT * from priorities";
    $res = $conn->query($sql);
    return $res;
}

function getStatuses()
{
    global $conn;
    $sql = "SELECT * from statuses";
    $res = $conn->query($sql);
    return $res;
}

function deleteTask()
{
    $id = $_POST['id'];

    global $conn;
    $sql = "DELETE FROM `tasks` WHERE id=$id";
    $res = $conn->query($sql);
    if ($res) {
        $_SESSION['message'] = "Task has been deleted successfully !";
    } else {
        $_SESSION['message'] = "Error!";
    }
    header('location: index.php');
}

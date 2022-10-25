<?php
//INCLUDE DATABASE FILE
include('database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();

function getTasks()
{
    global $conn;
    $sql = "SELECT
        ta.id as id ,
        ta.title as title ,
        ty.name as type,
        s.name as status,
        p.name as priority,
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
        ta.priority_id = p.id;
       ";
    $res = $conn->query($sql);
    return $res;
}


function saveTask()
{
    //CODE HERE
    //SQL INSERT
    extract($_POST);
    global $conn;
    $sql = "INSERT INTO tasks (title, type_id, status_id, priority_id, task_datetime , description)
            values ($title, $type, $status, $priority, $date,$description)";
    $res = $conn->query($sql);

    $_SESSION['message'] = "Task has been added successfully !";
    header('location: index.php');
}

function updateTask()
{
    //CODE HERE
    //SQL UPDATE
    $_SESSION['message'] = "Task has been updated successfully !";
    header('location: index.php');
}

function deleteTask()
{
    //CODE HERE
    //SQL DELETE
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}

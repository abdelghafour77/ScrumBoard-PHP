<?php
//INCLUDE DATABASE FILE
include('database.php');

//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();

function getTasks($status)
{
    global $conn;
    // $sql = "SELECT
    //     ta.id as id ,
    //     ta.title as title ,
    //     ty.name as type,
    //     ty.id as type_id,
    //     s.name as status,
    //     s.id as status_id,
    //     p.name as priority,
    //     p.id as priority_id,
    //     ta.task_datetime as task_datetime,
    //     ta.description as description
    // FROM
    //     tasks as ta ,
    //     priorities as p ,
    //     statuses as s ,
    //     types as ty
    // WHERE
    //     ta.type_id = ty.id
    // and 
    //     ta.status_id = s.id
    // and 
    //     ta.priority_id = p.id
    // and 
    //     s.name= '$status'";

    $sql = "SELECT tasks.*,
        statuses.name as status ,
        priorities.name as priority ,
        types.name as type 
    FROM 
        tasks 
    inner join priorities on tasks.priority_id = priorities.id
    inner join statuses on tasks.status_id = statuses.id 
    inner join types on tasks.type_id = types.id
    where statuses.name='$status';
            ";


    $res = mysqli_query($conn, $sql);
    return $res;
}

function saveTask()
{
    extract($_POST);

    if (empty($title) || empty($type) || empty($status) || empty($priority) || empty($date) || empty($description)) {
        $_SESSION['type_message'] = "error";
        $_SESSION['message'] = "One or some inputs are empty";
    } else {

        global $conn;
        $sql = "INSERT INTO tasks (title, type_id, status_id, priority_id, task_datetime , description)
            values (?,?,?,?,?,?)";
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 'ssssss', $title, $type, $status, $priority, $date, $description);
        $res = mysqli_stmt_execute($statement);

        if ($res) {
            $_SESSION['type_message'] = "success";
            $_SESSION['message'] = "Task has been added successfully !";
        } else {
            $_SESSION['type_message'] = "error";
            $_SESSION['message'] = "Error in insert to database !";
        }
    }
    header('location: index.php');
}

function updateTask()
{
    extract($_POST);
    global $conn;
    $sql = "UPDATE tasks SET title =? ,type_id=? ,status_id=? ,priority_id=? ,task_datetime=? ,description=? WHERE id=?";
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'sssssss', $title, $type, $status, $priority, $date, $description, $id);
    $res = mysqli_stmt_execute($statement);
    if ($res) {
        $_SESSION['type_message'] = "success";
        $_SESSION['message'] = "Task has been updated successfully !";
    } else {
        $_SESSION['type_message'] = "error";
        $_SESSION['message'] = "Error in update from database !";
    }
    header('location: index.php');
}

function getPriorities()
{
    global $conn;
    $sql = "SELECT * from priorities";
    $res = mysqli_query($conn, $sql);
    return $res;
}

function getStatuses()
{
    global $conn;
    $sql = "SELECT * from statuses";
    $res = mysqli_query($conn, $sql);
    return $res;
}

function deleteTask()
{
    $id = $_POST['id'];

    global $conn;
    $sql = "DELETE FROM tasks WHERE id=?";
    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 's', $id);
    $res = mysqli_stmt_execute($statement);
    if ($res) {
        $_SESSION['type_message'] = "success";
        $_SESSION['message'] = "Task has been deleted successfully !";
    } else {
        $_SESSION['type_message'] = "error";
        $_SESSION['message'] = "Error in delete !";
    }
    header('location: index.php');
}

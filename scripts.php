<?php
//INCLUDE DATABASE FILE
include('database.php');
//SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
session_start();

//ROUTING
if (isset($_POST['save']))        saveTask();
if (isset($_POST['update']))      updateTask();
if (isset($_POST['delete']))      deleteTask();
if (isset($_GET['id']))      getTask($_GET['id']);

function getTasks($status)
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
        ta.priority_id = p.id
    and 
        s.name= '$status'
       ";
    $res = $conn->query($sql);
    return $res;
}

function getTask($id)
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
        ta.priority_id = p.id
    and 
        ta.id= '$id'
       ";
    $res = $conn->query($sql);
    foreach ($res as $row) {
?>
        <div class="modal fade" id="myModalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="form" method="POST" action="scripts.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- start form -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                <label for="title"><?= $row['title'] ?></label>
                            </div>
                            <input type="hidden" name="id">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="bug" value="1" />
                                    <label class="form-check-label" for="bug"> Bug </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="feature" value="2" checked />
                                    <label class="form-check-label" for="feature"> Feature </label>
                                </div>

                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="priority" id="priority" aria-describedby="basic-addon3" required>
                                    <option disabled selected>Selected</option>
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                    <option value="4">Critical</option>
                                </select>
                                <label for="priority" class="form-label">Priority</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="status" id="status" aria-label="Status" aria-describedby="basic-addon3" required>
                                    <option disabled selected>Selected</option>
                                    <option value="1">To do</option>
                                    <option value="2">In progress</option>
                                    <option value="3">Done</option>
                                </select>
                                <label for="status" class="form-label">Status</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" name="date" class="form-control" id="date" aria-describedby="basic-addon3" required />
                                <label for="date" class="form-label">Date</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Description" style="min-height: 90px;" required>
                                    <?= $row['description'] ?>    
                                </textarea>
                                <label for="description" class="form-label">Description</label>
                            </div>
                            <!-- end form -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <div id="btn-add">
                                <button type="submit" name="save" class="btn btn-primary btn-add-task">Add</button>
                            </div>
                            <input type="hidden" id="id" value="" />
                            <div id="btn-update" style="display: none">
                                <button type="button" onclick="deleteTask()" id="deleteBtn" class="btn btn-danger">Delete</button>
                                <button type="button" onclick="updateTask()" id="updateBtn" class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
    }
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

function deleteTask()
{
    //CODE HERE
    //SQL DELETE
    $_SESSION['message'] = "Task has been deleted successfully !";
    header('location: index.php');
}

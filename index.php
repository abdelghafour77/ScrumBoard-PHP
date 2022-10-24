<?php
require_once 'core.php';
 $sql="select * from task;";  
 $tasks=$conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>YouCode | Scrum Board</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="Scrum Board created by AOUAD Abdelghafour" name="description" />
    <meta content="Abdelghefour AOUAD" name="author" />

    <!-- ================== BEGIN core-css ================== -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- CSS only -->
    <link rel="stylesheet" href="assets/css/default/app.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.1/sweetalert2.min.css"
      integrity="sha512-y6TjkITSFkRB9mZmDaJyDOsyHsYvOo3Np3iAKe02HgMDP4L4vbmbhlzNpbbIVC1x+GUUHvepTd1BKDe4kC6kNg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- ================== END core-css ================== -->
  </head>

  <body class="main-style">
    <!-- BEGIN #app -->
    <div id="app" class="app-without-sidebar">
      <!-- BEGIN #content -->
      <header>
        <nav class="navbar header-color">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <h3 class="fw-bold text-white logo">S.board</h3>
            </a>
          </div>
        </nav>

        <div class="container-fluid">
          <div class="bread">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#" class="text-decoration-none fw-bold title">Home</a></li>
              <li class="breadcrumb-item active title" aria-current="page">Scrum Board</li>
            </ol>
            <button type="button" class="btn btn-secondary rounded-pill float-end btn-add-task" onclick="createTask()" data-bs-toggle="modal" data-bs-target="#myModal">
              <i class="bi bi-plus"></i>
              Add Task
            </button>
          </div>
          <h2 class="title-board">Scrum Board</h2>
        </div>
      </header>
      <div id="content" class="app-content container-fluid">
        <div class="row" id="all-tasks">

          <!-- TODO -->
          <div class="col-md-4 col-sm-12 mb-3">
            <div class="card">
              <div class="card-header text-center header-color text-white bg-dark fw-bold list-header-color">To Do (<span id="count-todo">0</span>)</div>
              <div class="list-group list-group-flush" id="toDo">
              <?php foreach ( $tasks as $key => $task){ 
                if($task['status']==='To Do'){?>
                 <button onclick="getTask()" class="list-group-item card-color" data-bs-toggle="modal"
                  data-bs-target="#myModal">
                      <div class="row">
                      
                      <div class="col-1 my-auto">
                          <i class="fa-solid ${icon}"></i>
                      </div>
                      <div class="col-11">
                      <p class="fs-6 fw-semibold title m-0"><?php echo $task['title'] ; ?></p>
                      <small class="fw-light text-muted">#<?php echo $key+1 ; ?> created in <?php echo $task['date'] ; ?></small>
                          <div class="text-truncate text-break" title="<?php echo $task['description'] ; ?>">
                              <?php echo $task['description'] ; ?>
                          </div>
                          <span class="badge rounded-pill text-white blue-color"><?php echo $task['priority'] ; ?></span>
                          <span class="badge rounded-pill text-bg-secondary"><?php echo $task['type'] ; ?></span>
                      </div>
                      </div>
                  </button>
               <?php
                }
              }?>
              </div>
            </div>
          </div>
          <!-- END TO DO -->
          <!-- In Progress -->
          <div class="col-md-4 col-sm-12 mb-3">
            <div class="card">
              <div class="card-header text-center header-color text-white bg-dark fw-bold list-header-color">In Progress (<span id="count-in-progress">0</span>)</div>
              <div class="list-group list-group-flush" id="inProgress">
                

              <?php foreach ( $tasks as $key => $task){ 
                if($task['status']==='In Progress'){?>
                 <button onclick="getTask()" class="list-group-item card-color" data-bs-toggle="modal"
                  data-bs-target="#myModal">
                      <div class="row">
                      
                      <div class="col-1 my-auto">
                          <i class="fa-solid ${icon}"></i>
                      </div>
                      <div class="col-11">
                      <p class="fs-6 fw-semibold title m-0"><?php echo $task['title'] ; ?></p>
                      <small class="fw-light text-muted">#<?php echo $key+1 ; ?> created in <?php echo $task['date'] ; ?></small>
                          <div class="text-truncate text-break" title="<?php echo $task['description'] ; ?>">
                              <?php echo $task['description'] ; ?>
                          </div>
                          <span class="badge rounded-pill text-white blue-color"><?php echo $task['priority'] ; ?></span>
                          <span class="badge rounded-pill text-bg-secondary"><?php echo $task['type'] ; ?></span>
                      </div>
                      </div>
                  </button>
               <?php
                }
              }?>
              </div>
            </div>
          </div>
          <!-- END IN PROGRESS -->
          <!-- DONE -->
          <div class="col-md-4 col-sm-12 mb-3">
            <div class="card">
              <div class="card-header text-center header-color text-white bg-dark fw-bold list-header-color">Done (<span id="count-done">0</span>)</div>
              <div class="list-group list-group-flush" id="done">
              <?php foreach ( $tasks as $key => $task){ 
                if($task['status']==='Done'){?>
                 <button onclick="getTask()" class="list-group-item card-color" data-bs-toggle="modal"
                  data-bs-target="#myModal">
                      <div class="row">
                      
                      <div class="col-1 my-auto">
                          <i class="fa-solid ${icon}"></i>
                      </div>
                      <div class="col-11">
                      <p class="fs-6 fw-semibold title m-0"><?php echo $task['title'] ; ?></p>
                      <small class="fw-light text-muted">#<?php echo $key+1 ; ?> created in <?php echo $task['date'] ; ?></small>
                          <div class="text-truncate text-break" title="<?php echo $task['description'] ; ?>">
                              <?php echo $task['description'] ; ?>
                          </div>
                          <span class="badge rounded-pill text-white blue-color"><?php echo $task['priority'] ; ?></span>
                          <span class="badge rounded-pill text-bg-secondary"><?php echo $task['type'] ; ?></span>
                      </div>
                      </div>
                  </button>
               <?php
                }
              }?>
              </div>
            </div>
          </div>
          <!-- END DONE -->
        </div>
      </div>
      <!-- END #content -->
    </div>
    <!-- END #app -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form id="form" method="post" action="core.php">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Task</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- start form -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="title" id="title" placeholder="Title" />
                <label for="title">Title</label>
              </div>
              <div class="mb-3">
                <label class="form-label">Type</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" id="feature" value="Feature" checked />
                  <label class="form-check-label" for="feature"> Feature </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="type" id="bug" value="Bug" />
                  <label class="form-check-label" for="bug"> Bug </label>
                </div>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="priority" name="priority" aria-describedby="basic-addon3" required>
                  <option disabled selected>Selected</option>
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                  <option value="Critical">Critical</option>
                </select>
                <label for="priority" class="form-label">Priority</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="status" name="status" aria-label="Status" aria-describedby="basic-addon3" required>
                  <option disabled selected>Selected</option>
                  <option value="To Do">To do</option>
                  <option value="In Progress">In progress</option>
                  <option value="Done">Done</option>
                </select>
                <label for="status" class="form-label">Status</label>
              </div>
              <div class="form-floating mb-3">
                <input type="date" name="date" class="form-control" id="date" aria-describedby="basic-addon3" required />
                <label for="date" class="form-label">Date</label>
              </div>
              <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Description" required></textarea>
                <label for="description" class="form-label">Description</label>
              </div>
              <!-- end form -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <div id="btn-add">
                <button type="submit" onclick="addTask()" name="add" class="btn btn-primary btn-add-task">Add</button>
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
    <!-- BEGIN scroll-top-btn -->
    <a id="to-top" class="btn btn-icon btn-circle btn-success btn-scroll-to-top btn-add-task" data-toggle="scroll-to-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- END scroll-top-btn -->

    <!-- ================== BEGIN core-js ================== -->
    <!-- Import JQuery file JS -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- JavaScript Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Import data from file JS -->
    <script src="assets/js/data.js"></script>
    <!-- Import Main file JS -->
    <script src="assets/js/main.js"></script>
    <!-- ================== END core-js ================== -->
  </body>
</html>

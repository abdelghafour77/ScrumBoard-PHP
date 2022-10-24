//  Button to top
const toTop = document.querySelector("#to-top");
window.onscroll = function () { scrollFunction() };
function scrollFunction() {
  if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
    toTop.style.display = "block";
  } else {
    toTop.style.display = "none";
  }
}

toTop.addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
})

// Clear form and hide update & delete buttons 
function createTask() {
  document.getElementById("btn-update").style.display = "none";
  document.getElementById("btn-add").style.display = "block";
  document.getElementById('form').reset();
}

// Add task from modal
function addTask() {

  // Check if all input are valid
  if (document.getElementById("form").checkValidity()) {

    // Create object of task & get all data 
    let task = {
      title: document.getElementById("title").value,
      type: document.querySelector('input[name="type"]:checked').value,
      priority: document.getElementById('priority').value,
      status: document.getElementById('status').value,
      date: document.getElementById("date").value,
      description: document.getElementById("description").value
    };

    // Add task to array of tasks
    allTasks.push(task);

    // Hide form
    $("#myModal").modal('hide');

    // Print all tasks
    printTasks();
  } else {
    Swal.fire({
      showConfirmButton: false,
      icon: 'error',
      title: 'Fill all input'
    })
  }
}

// Get all data from array fo tasks using indes of task
function getTask(id) {

  // Set value for all inputs 
  if (allTasks[id].type == "Bug") {
    document.getElementById("bug").checked = true
  } else {
    document.getElementById("feature").checked = true
  }
  document.getElementById("title").value = allTasks[id].title;
  document.querySelector('input[name="type"]:checked').value = allTasks[id].type;
  document.getElementById('priority').value = allTasks[id].priority;
  document.getElementById('status').value = allTasks[id].status;
  document.getElementById("date").value = allTasks[id].date;
  document.getElementById("description").value = allTasks[id].description;
  document.getElementById("id").value = id;

  // Hide add button from modal
  document.getElementById("btn-update").style.display = "block";

  // Show add button from modal
  document.getElementById("btn-add").style.display = "none";

  // Show Modal
  $("#myModal").modal('show');
}

// Update task
function updateTask() {

  // Hide form
  $("#myModal").modal('hide');

  // Get index of task from hidden input
  let id = document.getElementById("id").value;

  // Create object of task
  let task = {
    title: document.getElementById("title").value,
    type: document.querySelector('input[name="type"]:checked').value,
    priority: document.getElementById('priority').value,
    status: document.getElementById('status').value,
    date: document.getElementById("date").value,
    description: document.getElementById("description").value
  };

  // Replace old task by new one 
  allTasks[id] = task;

  // Print all tasks
  printTasks();
}

// Delete task
function deleteTask() {

  // Get index of task from hidden input
  let id = document.getElementById("id").value;

  // Remove task from tasks
  allTasks.splice(id, 1);

  //Hide modal
  $("#myModal").modal('hide');

  // Print all tasks
  printTasks();
}

// Print all tasks
function printTasks() {
  // purge all tasks
  document.querySelector("#toDo").innerHTML = "";
  document.querySelector("#inProgress").innerHTML = "";
  document.querySelector("#done").innerHTML = "";

  // Declare variables 
  let div_task = "", counter_todo = 0, counter_in_progress = 0, counter_done = 0;

  allTasks.forEach((task, i) => {
    if (task.status === "To Do") {
      div_task = document.querySelector("#toDo");
      counter_todo++
      icon = "bi bi-clock-history";
    } else if (task.status === "In Progress") {
      div_task = document.querySelector("#inProgress");
      counter_in_progress++
      icon = "fa-spinner fa-spin-pulse"
    } else if (task.status === "Done") {
      div_task = document.querySelector("#done");
      counter_done++
      icon = "bi bi-check-circle text-success"
    }
    div_task.innerHTML +=
      `<button onclick="getTask(${i})" class="list-group-item card-color" data-bs-toggle="modal"
                data-bs-target="#myModal">
                    <div class="row">
                    
                    <div class="col-1 my-auto">
                        <i class="fa-solid ${icon}"></i>
                    </div>
                    <div class="col-11">
                    <p class="fs-6 fw-semibold title m-0">${task.title}</p>
                    <small class="fw-light text-muted">#${i + 1} created in ${task.date}</small>
                        <div class="text-truncate text-break" title="${task.description}">
                            ${task.description}
                        </div>
                        <span class="badge rounded-pill text-white blue-color">${task.priority}</span>
                        <span class="badge rounded-pill text-bg-secondary">${task.type}</span>
                    </div>
                    </div>
                </button>`;
    i++;
  });

  // Set tasks for each status
  document.getElementById("count-todo").innerText = counter_todo;
  document.getElementById("count-in-progress").innerText = counter_in_progress;
  document.getElementById("count-done").innerText = counter_done;

}
printTasks();
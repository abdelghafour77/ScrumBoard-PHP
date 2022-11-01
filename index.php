<?php
include('scripts.php');

$toDo = getTasks('To Do');
$inProgress = getTasks('In Progress');
$done = getTasks('Done');

$priorities = getPriorities();
$statuses = getStatuses();

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
	<link rel="stylesheet" href="assets/css/default/app.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.1/sweetalert2.min.css" integrity="sha512-y6TjkITSFkRB9mZmDaJyDOsyHsYvOo3Np3iAKe02HgMDP4L4vbmbhlzNpbbIVC1x+GUUHvepTd1BKDe4kC6kNg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="assets/css/style.css" />
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
					<div class="d-flex">
						<button type="button" class="btn btn-secondary rounded-pill float-end btn-add-task" data-bs-toggle="modal" data-bs-target="#login">
							Log In
						</button>
					</div>
				</div>
			</nav>

			<div class="container-fluid">
				<div class="bread">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#" class="text-decoration-none fw-bold title">Home</a></li>
						<li class="breadcrumb-item active title" aria-current="page">Scrum Board</li>
					</ol>
					<button type="button" class="btn btn-secondary rounded-pill float-end btn-add-task" onclick="addTask()" data-bs-toggle="modal" data-bs-target="#myModal">
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
						<div class="card-header text-center header-color text-white bg-dark fw-bold list-header-color">
							To Do (<span id="count-todo"><?= mysqli_num_rows($toDo); ?></span>)
						</div>
						<div class="list-group list-group-flush" id="toDo">
							<?php
							foreach ($toDo as $key => $row) { ?>
								<button type="button" class="list-group-item card-color" data-status="<?= $row['status_id'] ?>" data-id="<?= $row['id'] ?>" id="<?= $row['id'] ?>" onclick="getTask(<?= $row['id'] ?>)">
									<div class="row">

										<div class="col-1 my-auto d-flex justify-content-center">
											<i class="fa-solid d-flex bi bi-clock-history"></i>
										</div>
										<div class="col-11">
											<p class="fs-6 fw-semibold text-truncate title m-0" data="<?= $row['title'] ?>" title="<?= $row['title'] ?>">
												<?= $row['title'] ?>
											</p>
											<small class="fw-light text-muted" data="<?= $row['task_datetime'] ?>">#
												<?= $key + 1 ?> created in
												<?= date('d-m-Y', strtotime($row['task_datetime'])) ?>
											</small>
											<div class="text-truncate text-break" data="<?= $row['description'] ?>" title="<?= $row['description'] ?>">
												<?= $row['description'] ?>
											</div>
											<span class="badge rounded-pill text-white blue-color" data="<?= $row['priority_id'] ?>">
												<?= $row['priority'] ?>
											</span>
											<span class="badge rounded-pill text-bg-secondary" data="<?= $row['type_id'] ?>">
												<?= $row['type'] ?>
											</span>
										</div>
									</div>
								</button>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<!-- END TO DO -->
				<!-- In Progress -->
				<div class="col-md-4 col-sm-12 mb-3">
					<div class="card">
						<div class="card-header text-center header-color text-white bg-dark fw-bold list-header-color">
							In Progress (<span id="count-in-progress"><?= mysqli_num_rows($inProgress); ?></span>)
						</div>
						<div class="list-group list-group-flush" id="inProgress">
							<?php
							foreach ($inProgress as $key => $row) { ?>
								<button type="button" class="list-group-item card-color" data-status="<?= $row['status_id'] ?>" data-id="<?= $row['id'] ?>" id="<?= $row['id'] ?>" onclick="getTask(<?= $row['id'] ?>)">
									<div class="row">

										<div class="col-1 my-auto d-flex justify-content-center">
											<i class="fa-solid d-flex fa-spinner fa-spin-pulse"></i>
										</div>
										<div class="col-11">
											<p class="fs-6 fw-semibold text-truncate title m-0" data="<?= $row['title'] ?>" title="<?= $row['title'] ?>">
												<?= $row['title'] ?>
											</p>
											<small class="fw-light text-muted" data="<?= $row['task_datetime'] ?>">#
												<?= $key + 1 ?> created in
												<?= date('d-m-Y', strtotime($row['task_datetime'])) ?>
											</small>
											<div class="text-truncate text-break" data="<?= $row['description'] ?>" title="<?= $row['description'] ?>">
												<?= $row['description'] ?>
											</div>
											<span class="badge rounded-pill text-white blue-color" data="<?= $row['priority_id'] ?>">
												<?= $row['priority'] ?>
											</span>
											<span class="badge rounded-pill text-bg-secondary" data="<?= $row['type_id'] ?>">
												<?= $row['type'] ?>
											</span>
										</div>
									</div>
								</button>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<!-- END IN PROGRESS -->
				<!-- DONE -->
				<div class="col-md-4 col-sm-12 mb-3">
					<div class="card">
						<div class="card-header text-center header-color text-white bg-dark fw-bold list-header-color">
							Done (<span id="count-done"><?= mysqli_num_rows($done); ?></span>)
						</div>
						<div class="list-group list-group-flush" id="done">
							<?php
							foreach ($done as $key => $row) { ?>
								<button type="button" class="list-group-item card-color" data-status="<?= $row['status_id'] ?>" data-id="<?= $row['id'] ?>" id="<?= $row['id'] ?>" onclick="getTask(<?= $row['id'] ?>)">
									<div class="row">

										<div class="col-1 my-auto d-flex justify-content-center">
											<i class="fa-solid d-flex bi bi-check-circle text-success"></i>
										</div>
										<div class="col-11">
											<p class="fs-6 fw-semibold text-truncate title m-0" data="<?= $row['title'] ?>" title="<?= $row['title'] ?>">
												<?= $row['title'] ?>
											</p>
											<small class="fw-light text-muted" data="<?= $row['task_datetime'] ?>">#
												<?= $key + 1 ?> created in
												<?= date('d-m-Y', strtotime($row['task_datetime'])) ?>
											</small>
											<div class="text-truncate text-break" data="<?= $row['description'] ?>" title="<?= $row['description'] ?>">
												<?= $row['description'] ?>
											</div>
											<span class="badge rounded-pill text-white blue-color" data="<?= $row['priority_id'] ?>">
												<?= $row['priority'] ?>
											</span>
											<span class="badge rounded-pill text-bg-secondary" data="<?= $row['type_id'] ?>">
												<?= $row['type'] ?>
											</span>
										</div>
									</div>
								</button>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<!-- END DONE -->
			</div>
		</div>
		<!-- END #content -->
	</div>
	<!-- END #app -->
	<!-- START Modal Login -->
	<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<form id="login" method="POST" action="" autocomplete="off">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Log In</h1>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- start form -->
						<div class="form-floating mb-3">
							<input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
							<label for="email">Email</label>
						</div>
						<div class="form-floating mb-3">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
							<label for="password">Password</label>
						</div>
						<!-- end form -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="save" class="btn btn-primary btn-add-task">Connect</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END Modal Login -->
	<!-- Modal task -->
	<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="">
							<label for="title">Title</label>
						</div>
						<input type="hidden" name="id" id="id">
						<div class=" mb-3">
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
							<select class="form-select" name="priority" id="priority" aria-describedby="basic-addon3">
								<option disabled selected value="">Choose priority</option>
								<?php
								foreach ($priorities as $priority) {
									echo '<option value="' . $priority["id"] . '">' . $priority["name"] . '</option>';
								}
								?>
							</select>
							<label for="priority" class="form-label">Priority</label>
						</div>
						<div class="form-floating mb-3">
							<select class="form-select" name="status" id="status" aria-label="Status" aria-describedby="basic-addon3">
								<option disabled selected value="">Choose status</option>
								<?php
								foreach ($statuses as $status) {
									echo '<option value="' . $status["id"] . '">' . $status["name"] . '</option>';
								}
								?>
							</select>
							<label for="status" class="form-label">Status</label>
						</div>
						<div class="form-floating mb-3">
							<input type="datetime-local" name="date" class="form-control" id="date" aria-describedby="basic-addon3" />
							<label for="date" class="form-label">Date</label>
						</div>
						<div class="form-floating mb-3">
							<textarea class="form-control" name="description" id="description" rows="4" placeholder="Description" style="min-height: 90px;"></textarea>
							<label for="description" class="form-label">Description</label>
						</div>
						<input type="hidden" id="type" name="" value="">
						<!-- end form -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<div id="btn-add">
							<button type="submit" name="save" onclick="setType('save')" class="btn btn-primary btn-add-task">Add</button>
						</div>
						<input type="hidden" id="id" value="" />
						<div id="btn-update" style="display: none">
							<button type="submit" name="delete" onclick="setType('delete'), delteValidation()" id="deleteBtn" class="btn btn-danger">Delete</button>
							<button type="submit" name="update" onclick="setType('update')" id="updateBtn" class="btn btn-warning">Update</button>
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
	<script src="assets/js/jquery.min.js"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- JavaScript Sweet Alert 2 -->
	<script src="assets/js/sweetalert.js"></script>
	<!-- Validator form -->
	<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
	<!-- Import Main file JS -->
	<script src="assets/js/scripts.js"></script>
	<script>
		<?php if (isset($_SESSION['message'])) { ?>
			const Toast = Swal.mixin({
				width: '25em',
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 4000,
				timerProgressBar: false,
				didOpen: (toast) => {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			})

			Toast.fire({
				icon: '<?= $_SESSION['type_message'] ?>',
				title: '<?= $_SESSION['message'] ?>'
			})
		<?php
			unset($_SESSION['type_message']);
			unset($_SESSION['message']);
		} ?>
	</script>
	<!-- ================== END core-js ================== -->
</body>

</html>
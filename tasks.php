<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "teamleader")) {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	$text = "All Task";
	if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Due Today") {
		$text = "Due Today";
		$tasks = get_all_tasks_due_today($conn);
		$num_task = count_tasks_due_today($conn);
	} else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "Overdue") {
		$text = "Overdue";
		$tasks = get_all_tasks_overdue($conn);
		$num_task = count_tasks_overdue($conn);
	} else if (isset($_GET['due_date']) &&  $_GET['due_date'] == "No Deadline") {
		$text = "No Deadline";
		$tasks = get_all_tasks_NoDeadline($conn);
		$num_task = count_tasks_NoDeadline($conn);
	} else {
		$tasks = get_all_tasks($conn);
		$num_task = count_tasks($conn);
	}
	$users = get_all_users($conn);


?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>All Tasks</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">

	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1">
				<h4 class="title">All Tasks <a href="create_task.php">Create Task</a></h4>
				<div class="task-filters">
					<a href="tasks.php" class="filter-btn <?php echo !isset($_GET['due_date']) ? 'active' : ''; ?>">
						<i class="fa fa-list"></i> All Tasks
					</a>
					<a href="tasks.php?due_date=Due Today" class="filter-btn <?php echo (isset($_GET['due_date']) && $_GET['due_date'] == 'Due Today') ? 'active' : ''; ?>">
						<i class="fa fa-calendar"></i> Due Today
					</a>
					<a href="tasks.php?due_date=Overdue" class="filter-btn <?php echo (isset($_GET['due_date']) && $_GET['due_date'] == 'Overdue') ? 'active' : ''; ?>">
						<i class="fa fa-calendar-times-o"></i> Overdue
					</a>
					<a href="tasks.php?due_date=No Deadline" class="filter-btn <?php echo (isset($_GET['due_date']) && $_GET['due_date'] == 'No Deadline') ? 'active' : ''; ?>">
						<i class="fa fa-calendar-minus-o"></i> No Deadline
					</a>
				</div>
				<?php if (isset($_GET['success'])) { ?>
					<div class="success" role="alert">
						<?php echo stripcslashes($_GET['success']); ?>
					</div>
				<?php } ?>
				<?php if ($tasks != 0) { ?>
					<table class="main-table">
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Description</th>
							<th>Assigned To</th>
							<th>Due Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						<?php $i = 0;
						foreach ($tasks as $task) { ?>
							<tr>
								<td><?= ++$i ?></td>
								<td><?= $task['title'] ?></td>
								<td><?= $task['description'] ?></td>
								<td>
									<?php
									foreach ($users as $user) {
										if ($user['id'] == $task['assigned_to']) {
											echo $user['full_name'];
										}
									} ?>
								</td>
								<td>
									<?php
									if ($task['due_date'] == "" || $task['due_date'] == "0000-00-00") {
										echo "No Deadline";
									} else {
										echo date('M d, Y', strtotime($task['due_date']));
									}
									?>
								</td>
								<td>
									<?php
									$status_class = '';
									switch ($task['status']) {
										case 'pending':
											$status_class = 'status-pending';
											break;
										case 'in_progress':
											$status_class = 'status-progress';
											break;
										case 'completed':
											$status_class = 'status-completed';
											break;
									}
									?>
									<span class="status <?php echo $status_class; ?>"><?= $task['status'] ?></span>
								</td>
								<td>
									<a href="edit-task.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
									<a href="delete-task.php?id=<?= $task['id'] ?>" class="delete-btn">Delete</a>
								</td>
							</tr>
						<?php	} ?>
					</table>
				<?php } else { ?>
					<h3>Empty</h3>
				<?php  } ?>

			</section>
		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(4)");
			active.classList.add("active");
		</script>
	</body>

	</html>
<?php } else {
	$em = "First login";
	header("Location: login.php?error=$em");
	exit();
}
?>
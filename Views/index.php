<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	if ($_SESSION['role'] == "admin") {
		$todaydue_task = count_tasks_due_today($conn);
		$overdue_task = count_tasks_overdue($conn);
		$nodeadline_task = count_tasks_NoDeadline($conn);
		$num_task = count_tasks($conn);
		$num_users = count_users($conn);
		$num_teamleaders = count_team_leaders($conn);
		$pending = count_pending_tasks($conn);
		$in_progress = count_in_progress_tasks($conn);
		$completed = count_completed_tasks($conn);
	} else if ($_SESSION['role'] == "teamleader") {
		$num_my_task = count_my_tasks($conn, $_SESSION['id']);
		$overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
		$nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
		$pending = count_my_pending_tasks($conn, $_SESSION['id']);
		$in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
		$completed = count_my_completed_tasks($conn, $_SESSION['id']);
		$team_members = count_team_members($conn, $_SESSION['id']);
	} else {
		$num_my_task = count_my_tasks($conn, $_SESSION['id']);
		$overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
		$nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
		$pending = count_my_pending_tasks($conn, $_SESSION['id']);
		$in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
		$completed = count_my_completed_tasks($conn, $_SESSION['id']);
	}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Dashboard</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1">
				<?php if ($_SESSION['role'] == "admin") { ?>
					<div class="dashboard">
						<a href="user.php" class="dashboard-item tasks">
							<i class="fa fa-user-circle-o"></i>
							<div class="number"><?= $num_users ?></div>
							<div class="label">Total Team Members</div>
						</a>
						<a href="tasks.php" class="dashboard-item tasks">
							<i class="fa fa-list-alt"></i>
							<div class="number"><?= $num_task ?></div>
							<div class="label">All Tasks</div>
						</a>
						<a href="tasks.php?status=pending" class="dashboard-item pending">
							<i class="fa fa-hourglass-half"></i>
							<div class="number"><?= $pending ?></div>
							<div class="label">Pending</div>
						</a>
						<a href="tasks.php?status=in_progress" class="dashboard-item tasks">
							<i class="fa fa-rocket"></i>
							<div class="number"><?= $in_progress ?></div>
							<div class="label">In Progress</div>
						</a>
						<a href="tasks.php?status=completed" class="dashboard-item completed">
							<i class="fa fa-trophy"></i>
							<div class="number"><?= $completed ?></div>
							<div class="label">Completed</div>
						</a>
						<a href="tasks.php?due_date=Due Today" class="dashboard-item pending">
							<i class="fa fa-calendar-check-o"></i>
							<div class="number"><?= $todaydue_task ?></div>
							<div class="label">Due Today</div>
						</a>
						<a href="tasks.php?due_date=Overdue" class="dashboard-item pending">
							<i class="fa fa-calendar-times-o"></i>
							<div class="number"><?= $overdue_task ?></div>
							<div class="label">Overdue</div>
						</a>
						<a href="tasks.php?due_date=No Deadline" class="dashboard-item pending">
							<i class="fa fa-calendar-minus-o"></i>
							<div class="number"><?= $nodeadline_task ?></div>
							<div class="label">No Deadline</div>
						</a>
					</div>
				<?php } else if ($_SESSION['role'] == "teamleader") { ?>
					<div class="dashboard">
						<a href="my_task.php" class="dashboard-item tasks">
							<i class="fa fa-briefcase"></i>
							<div class="number"><?= $num_my_task ?></div>
							<div class="label">My Tasks</div>
						</a>
						<a href="my_task.php?status=pending" class="dashboard-item pending">
							<i class="fa fa-hourglass-half"></i>
							<div class="number"><?= $pending ?></div>
							<div class="label">Pending</div>
						</a>
						<a href="my_task.php?status=in_progress" class="dashboard-item tasks">
							<i class="fa fa-rocket"></i>
							<div class="number"><?= $in_progress ?></div>
							<div class="label">In Progress</div>
						</a>
						<a href="my_task.php?status=completed" class="dashboard-item completed">
							<i class="fa fa-trophy"></i>
							<div class="number"><?= $completed ?></div>
							<div class="label">Completed</div>
						</a>
						<a href="my_task.php?status=overdue" class="dashboard-item pending">
							<i class="fa fa-calendar-times-o"></i>
							<div class="number"><?= $overdue_task ?></div>
							<div class="label">Overdue</div>
						</a>
						<a href="my_task.php?status=no_deadline" class="dashboard-item pending">
							<i class="fa fa-calendar-minus-o"></i>
							<div class="number"><?= $nodeadline_task ?></div>
							<div class="label">No Deadline</div>
						</a>
					</div>
				<?php } else { ?>
					<div class="dashboard">
						<a href="my_task.php" class="dashboard-item tasks">
							<i class="fa fa-briefcase"></i>
							<div class="number"><?= $num_my_task ?></div>
							<div class="label">My Tasks</div>
						</a>
						<a href="my_task.php?status=pending" class="dashboard-item pending">
							<i class="fa fa-hourglass-half"></i>
							<div class="number"><?= $pending ?></div>
							<div class="label">Pending</div>
						</a>
						<a href="my_task.php?status=in_progress" class="dashboard-item tasks">
							<i class="fa fa-rocket"></i>
							<div class="number"><?= $in_progress ?></div>
							<div class="label">In Progress</div>
						</a>
						<a href="my_task.php?status=completed" class="dashboard-item completed">
							<i class="fa fa-trophy"></i>
							<div class="number"><?= $completed ?></div>
							<div class="label">Completed</div>
						</a>
						<a href="my_task.php?status=overdue" class="dashboard-item pending">
							<i class="fa fa-calendar-times-o"></i>
							<div class="number"><?= $overdue_task ?></div>
							<div class="label">Overdue</div>
						</a>
						<a href="my_task.php?status=no_deadline" class="dashboard-item pending">
							<i class="fa fa-calendar-minus-o"></i>
							<div class="number"><?= $nodeadline_task ?></div>
							<div class="label">No Deadline</div>
						</a>
					</div>
				<?php } ?>
			</section>
		</div>

		<script type="text/javascript">
			var active = document.querySelector("#navList li:nth-child(1)");
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
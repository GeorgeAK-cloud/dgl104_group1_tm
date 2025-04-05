<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	include "DB_connection.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	$tasks = get_all_tasks_by_id($conn, $_SESSION['id']);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>My Tasks</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<style>
			.status {
				padding: 5px 10px;
				border-radius: 15px;
				font-size: 0.9em;
				text-transform: capitalize;
			}

			.status-pending {
				background-color: #ffeeba;
				color: #856404;
			}

			.status-progress {
				background-color: #b8daff;
				color: #004085;
			}

			.status-completed {
				background-color: #c3e6cb;
				color: #155724;
			}
		</style>
	</head>

	<body>
		<input type="checkbox" id="checkbox">
		<?php include "inc/header.php" ?>
		<div class="body">
			<?php include "inc/nav.php" ?>
			<section class="section-1">
				<h4 class="title">My Tasks</h4>
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
							<th>Status</th>
							<th>Due Date</th>
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
									<?php
									if ($task['due_date'] == "" || $task['due_date'] == "0000-00-00") {
										echo "No Deadline";
									} else {
										echo date('M d, Y', strtotime($task['due_date']));
									}
									?>
								</td>
								<td>
									<a href="edit-task-member.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
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
			var active = document.querySelector("#navList li:nth-child(2)");
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
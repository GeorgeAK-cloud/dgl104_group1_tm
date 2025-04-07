<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	include "DB_connection.php";
	include "app/Model/Notification.php";
	include "app/Model/User.php";

	// Handle clear all notifications
	if (isset($_GET['clear_all'])) {
		delete_all_notifications($conn, $_SESSION['id']);
		header("Location: notifications.php?success=All notifications have been cleared");
		exit();
	}

	$notifications = get_all_my_notifications($conn, $_SESSION['id']);
	$unread_count = count_notification($conn, $_SESSION['id']);

	// Debug information
	error_log("User ID: " . $_SESSION['id'] . " Role: " . $_SESSION['role']);
	error_log("Number of notifications: " . ($notifications ? count($notifications) : 0));

	// Mark all as read if requested
	if (isset($_GET['mark_all_read'])) {
		mark_all_notifications_as_read($conn, $_SESSION['id']);
		header("Location: notifications.php");
		exit();
	}
} else {
	header("Location: login.php");
	exit();
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Notifications</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<style>
		.clear-btn {
			background-color: #dc3545;
			color: white;
			padding: 8px 15px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			text-decoration: none;
			display: inline-block;
			margin-bottom: 15px;
		}

		.clear-btn:hover {
			background-color: #c82333;
		}

		.success-message {
			background-color: #28a745;
			color: white;
			padding: 10px;
			border-radius: 4px;
			margin-bottom: 15px;
		}
	</style>
</head>

<body>
	<input type="checkbox" id="checkbox">
	<?php include "inc/header.php" ?>
	<div class="body">
		<?php include "inc/nav.php" ?>
		<section class="section-1">
			<h4 class="title">All Notifications</h4>
			<?php if (isset($_GET['success'])) { ?>
				<div class="success-message">
					<?php echo htmlspecialchars($_GET['success']); ?>
				</div>
			<?php } ?>

			<?php if ($notifications != 0) { ?>
				<a href="notifications.php?clear_all=1" class="clear-btn" onclick="return confirm('Are you sure you want to clear all notifications?');">
					<i class="fa fa-trash"></i> Clear All Notifications
				</a>
				<table class="main-table">
					<tr>
						<th>#</th>
						<th>Message</th>
						<th>Type</th>
						<th>Date</th>
					</tr>
					<?php $i = 0;
					foreach ($notifications as $notification) { ?>
						<tr>
							<td><?= ++$i ?></td>
							<td><?= $notification['message'] ?></td>
							<td><?= $notification['type'] ?></td>
							<td><?php
								$date = new DateTime($notification['date']);
								echo $date->format('M d, Y');
								?></td>
						</tr>
					<?php } ?>
				</table>
			<?php } else { ?>
				<h3>You have zero notification</h3>
			<?php } ?>
		</section>
	</div>

	<script>
		// Make the notifications link in nav active
		var active = document.querySelector("#navList li:nth-child(4)");
		active.classList.add("active");
	</script>
</body>

</html>
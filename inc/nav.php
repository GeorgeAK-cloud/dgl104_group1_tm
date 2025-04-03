<?php
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
	include dirname(__DIR__) . "/DB_connection.php";
	include dirname(__DIR__) . "/app/Model/Notification.php";
	$unread_count = count_notification($conn, $_SESSION['id']);
}
?>
<nav class="side-bar">
	<div class="user-p">
		<img src="img/user.png">
		<h4>@<?= $_SESSION['username'] ?></h4>
	</div>

	<?php if ($_SESSION['role'] == "member") { ?>
		<!-- Member Navigation Bar -->
		<ul id="navList">
			<li>
				<a href="index.php">
					<i class="fa fa-th-large" aria-hidden="true"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="my_task.php">
					<i class="fa fa-briefcase" aria-hidden="true"></i>
					<span>My Task</span>
				</a>
			</li>
			<li>
				<a href="profile.php">
					<i class="fa fa-user-circle" aria-hidden="true"></i>
					<span>Profile</span>
				</a>
			</li>
			<li>
				<a href="notifications.php">
					<i class="fa fa-bell-o" aria-hidden="true"></i>
					<span>Notifications</span>
					<?php if (isset($unread_count) && $unread_count > 0): ?>
						<small class="notification-badge"><?php echo $unread_count; ?></small>
					<?php endif; ?>
				</a>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-power-off" aria-hidden="true"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	<?php } else if ($_SESSION['role'] == "teamleader") { ?>
		<!-- Team Leader Navigation Bar -->
		<ul id="navList">
			<li>
				<a href="index.php">
					<i class="fa fa-th-large" aria-hidden="true"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="my_task.php">
					<i class="fa fa-briefcase" aria-hidden="true"></i>
					<span>My Tasks</span>
				</a>
			</li>
			<li>
				<a href="create_task.php">
					<i class="fa fa-plus-circle" aria-hidden="true"></i>
					<span>Create Task</span>
				</a>
			</li>
			<li>
				<a href="tasks.php">
					<i class="fa fa-list-alt" aria-hidden="true"></i>
					<span>All Tasks</span>
				</a>
			</li>
			<li>
				<a href="profile.php">
					<i class="fa fa-user-circle" aria-hidden="true"></i>
					<span>Profile</span>
				</a>
			</li>
			<li>
				<a href="notifications.php">
					<i class="fa fa-bell-o" aria-hidden="true"></i>
					<span>Notifications</span>
					<?php if (isset($unread_count) && $unread_count > 0): ?>
						<small class="notification-badge"><?php echo $unread_count; ?></small>
					<?php endif; ?>
				</a>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-power-off" aria-hidden="true"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	<?php } else { ?>
		<!-- Admin Navigation Bar -->
		<ul id="navList">
			<li>
				<a href="index.php">
					<i class="fa fa-th-large" aria-hidden="true"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="user.php">
					<i class="fa fa-users" aria-hidden="true"></i>
					<span>Manage Users</span>
				</a>
			</li>
			<li>
				<a href="create_task.php">
					<i class="fa fa-plus-circle" aria-hidden="true"></i>
					<span>Create Task</span>
				</a>
			</li>
			<li>
				<a href="tasks.php">
					<i class="fa fa-list-alt" aria-hidden="true"></i>
					<span>All Tasks</span>
				</a>
			</li>
			<li>
				<a href="notifications.php">
					<i class="fa fa-bell-o" aria-hidden="true"></i>
					<span>Notifications</span>
					<?php if (isset($unread_count) && $unread_count > 0): ?>
						<small class="notification-badge"><?php echo $unread_count; ?></small>
					<?php endif; ?>
				</a>
			</li>
			<li>
				<a href="logout.php">
					<i class="fa fa-power-off" aria-hidden="true"></i>
					<span>Logout</span>
				</a>
			</li>
		</ul>
	<?php } ?>
</nav>
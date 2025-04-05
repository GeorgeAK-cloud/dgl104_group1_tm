<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['full_name']) && isset($_POST['role']) && $_SESSION['role'] == 'admin') {
		include "../DB_connection.php";

		function validate_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$user_name = validate_input($_POST['user_name']);
		$password = validate_input($_POST['password']);
		$full_name = validate_input($_POST['full_name']);
		$role = validate_input($_POST['role']);
		$id = validate_input($_POST['id']);

		if (empty($user_name)) {
			$em = "User name is required";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else if (empty($password)) {
			$em = "Password is required";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else if (empty($full_name)) {
			$em = "Full name is required";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else if (empty($role)) {
			$em = "Role is required";
			header("Location: ../edit-user.php?error=$em&id=$id");
			exit();
		} else {
			include "Model/User.php";

			// Only hash password if it's changed (not the default asterisks)
			if ($password !== "**********") {
				$password = password_hash($password, PASSWORD_DEFAULT);
			} else {
				// Get the current user to keep their existing password
				$current_user = get_user_by_id($conn, $id);
				$password = $current_user['password'];
			}

			$data = array($full_name, $user_name, $password, $role, $id);
			update_user($conn, $data);

			$em = "User updated successfully";
			header("Location: ../edit-user.php?success=$em&id=$id");
			exit();
		}
	} else {
		$em = "Unknown error occurred";
		header("Location: ../edit-user.php?error=$em");
		exit();
	}
} else {
	$em = "First login";
	header("Location: ../edit-user.php?error=$em");
	exit();
}

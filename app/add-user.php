<?php
session_start();
if (isset($_POST['user_name']) && isset($_POST['password']) && isset($_POST['role']) && isset($_POST['full_name'])) {
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
	$role = validate_input($_POST['role']);
	$full_name = validate_input($_POST['full_name']);

	if (empty($user_name)) {
		$em = "User name is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	} else if (empty($password)) {
		$em = "Password is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	} else if (empty($role)) {
		$em = "Role is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	} else if (empty($full_name)) {
		$em = "Full name is required";
		header("Location: ../add-user.php?error=$em");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->execute([$user_name]);

		if ($stmt->rowCount() == 1) {
			$em = "Username already exists";
			header("Location: ../add-user.php?error=$em");
			exit();
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users (username, password, role, full_name) VALUES (?, ?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->execute([$user_name, $password, $role, $full_name]);

			$sm = "New user created successfully";
			header("Location: ../add-user.php?success=$sm");
			exit();
		}
	}
} else {
	$em = "Unknown error occurred";
	header("Location: ../add-user.php?error=$em");
	exit();
}

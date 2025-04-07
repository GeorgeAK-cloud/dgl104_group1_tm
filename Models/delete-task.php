<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
  include "DB_connection.php";
  include "app/Model/Task.php";
  include "app/Model/Notification.php";

  if (!isset($_GET['id'])) {
    header("Location: tasks.php");
    exit();
  }
  $id = $_GET['id'];
  $task = get_task_by_id($conn, $id);

  if ($task == 0) {
    header("Location: tasks.php");
    exit();
  }

  // Get task details before deletion for notification
  $task_title = $task['title'];
  $assigned_to = $task['assigned_to'];

  // Delete the task
  $data = array($id);
  delete_task($conn, $data);

  // Get all members and team leaders
  $sql = "SELECT * FROM users WHERE role IN ('member', 'teamleader')";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $users = $stmt->fetchAll();

  // Create notification for each user
  foreach ($users as $user) {
    $message = "Task '$task_title' has been deleted by admin";
    $notif_data = array(
      $message,
      $user['id'],
      'task_deleted'
    );

    // Create notification
    insert_notification($conn, $notif_data);

    // Log notification creation for debugging
    error_log("Created notification for user ID: " . $user['id'] . " with message: " . $message);
  }

  // Special notification for the assigned user if they exist
  if ($assigned_to) {
    $message = "Task '$task_title' that was assigned to you has been deleted by admin";
    $notif_data = array(
      $message,
      $assigned_to,
      'task_deleted_assigned'
    );
    insert_notification($conn, $notif_data);
  }

  $sm = "Deleted Successfully";
  header("Location: tasks.php?success=$sm");
  exit();
} else {
  $em = "First login";
  header("Location: login.php?error=$em");
  exit();
}

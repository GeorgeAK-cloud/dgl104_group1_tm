<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

    if (isset($_POST['status']) && isset($_POST['id']) && ($_SESSION['role'] == "member" || $_SESSION['role'] == "teamleader")) {
        include "../DB_connection.php";

        function validate_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $status = validate_input($_POST['status']);
        $id = validate_input($_POST['id']);

        if (empty($status)) {
            $em = "Status is required";
            header("Location: ../edit-task-member.php?error=$em&id=$id");
            exit();
        } else {
            include "Model/Task.php";
            $data = array($status, $id);
            update_task_status($conn, $data);

            $sm = "Task updated successfully";
            header("Location: ../edit-task-member.php?success=$sm&id=$id");
            exit();
        }
    } else {
        $em = "Unknown error occurred";
        header("Location: ../edit-task-member.php?error=$em");
        exit();
    }
} else {
    $em = "First login";
    header("Location: ../edit-task-member.php?error=$em");
    exit();
}

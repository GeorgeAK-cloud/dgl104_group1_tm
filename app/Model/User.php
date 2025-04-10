<?php

function get_all_users($conn)
{
    $sql = "SELECT * FROM users WHERE role IN ('member', 'teamleader')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $users = $stmt->fetchAll();
    } else $users = 0;

    return $users;
}

function count_team_members($conn, $teamleader_id)
{
    $sql = "SELECT id FROM users WHERE role='member'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);

    return $stmt->rowCount();
}

function count_team_leaders($conn)
{
    $sql = "SELECT id FROM users WHERE role='teamleader'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);

    return $stmt->rowCount();
}

function insert_user($conn, $data)
{
    $sql = "INSERT INTO users (full_name, username, password, role) VALUES(?,?,?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}

function update_user($conn, $data)
{
    $sql = "UPDATE users SET full_name=?, username=?, password=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}

function delete_user($conn, $data)
{
    // First, update all tasks assigned to this user to have assigned_to = NULL
    $sql = "UPDATE tasks SET assigned_to = NULL WHERE assigned_to = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$data[0]]);  // $data[0] contains the user ID

    // Then delete the user
    $sql = "DELETE FROM users WHERE id=? AND role=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}


function get_user_by_id($conn, $id)
{
    $sql = "SELECT * FROM users WHERE id =? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
    } else $user = 0;

    return $user;
}

function update_profile($conn, $data)
{
    $sql = "UPDATE users SET full_name=?,  password=? WHERE id=? ";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}

function count_users($conn)
{
    $sql = "SELECT id FROM users WHERE role IN ('member', 'teamleader')";
    $stmt = $conn->prepare($sql);
    $stmt->execute([]);

    return $stmt->rowCount();
}

<?php
if (!function_exists('get_notifications')) {

    function get_notifications($conn, $user_id)
    {
        $sql = "SELECT * FROM notifications WHERE recipient = ? ORDER BY date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    function get_unread_notifications_count($conn, $user_id)
    {
        $sql = "SELECT COUNT(*) as count FROM notifications WHERE recipient = ? AND is_read = 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetch();
        return $result['count'];
    }

    function mark_notification_as_read($conn, $notification_id)
    {
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$notification_id]);
    }

    function mark_all_notifications_as_read($conn, $user_id)
    {
        $sql = "UPDATE notifications SET is_read = 1 WHERE recipient = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
    }

    function insert_notification($conn, $data)
    {
        $current_date = date('Y-m-d'); // Get current date in YYYY-mm-dd format
        $data[] = $current_date; // Add the date to the data array
        $sql = "INSERT INTO notifications (message, recipient, type, date) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    function notification_make_read($conn, $recipient_id, $notification_id)
    {
        $sql = "UPDATE notifications SET is_read=1 WHERE id=? AND recipient=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$notification_id, $recipient_id]);
    }

    function delete_all_notifications($conn, $user_id)
    {
        $sql = "DELETE FROM notifications WHERE recipient = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
    }

    // Legacy functions for backward compatibility
    function get_all_my_notifications($conn, $id)
    {
        $sql = "SELECT * FROM notifications WHERE recipient = ? ORDER BY date DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $notifications = $stmt->fetchAll();
        } else {
            $notifications = 0;
        }

        return $notifications;
    }

    function count_notification($conn, $id)
    {
        $sql = "SELECT COUNT(*) as count FROM notifications WHERE recipient = ? AND is_read = 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result['count'];
    }
}

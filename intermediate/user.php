<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_type']) && isset($_SESSION['user_id'])) {
    $userType = $_SESSION['user_type'];
    $userId = $_SESSION['user_id'];
    echo json_encode(['success' => true, 'userType' => $userType, 'userId' => $userId]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
}
?>

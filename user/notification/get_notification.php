<?php
// Turn off error reporting to the screen so it doesn't break JSON

header('Content-Type: application/json');

include '../../db.php'; 
session_start();

$response = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $sql = "SELECT id, message,created_at,is_read FROM notifications WHERE user_id = ? 
    ORDER BY created_at DESC ";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
    } else {
        // Log error internally, don't echo it
    }
}

// Ensure we ALWAYS send valid JSON, even if empty
echo json_encode($response);
exit;
?>
<?php
include("../includes/db.php");
include("../includes/functions.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weeklyWeightId = sanitize_input($_POST["weekly_weight_id"]);
    $deleteQuery = "DELETE FROM weekly_weights WHERE id = $weeklyWeightId AND user_id = $userId";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Weight removed successfully";
    } else {
        echo "Error removing weight: " . $conn->error;
    }
}
?>

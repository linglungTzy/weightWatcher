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
    $newWeight = sanitize_input($_POST["new_weight"]);

    $updateQuery = "UPDATE weekly_weights SET weight = '$newWeight' WHERE id = $weeklyWeightId AND user_id = $userId";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Weight updated successfully";
    } else {
        echo "Error updating weight: " . $conn->error;
    }
}
?>

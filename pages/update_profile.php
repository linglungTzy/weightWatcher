<?php
include("../includes/db.php");
include("../includes/functions.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Error: User not authenticated";
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weight = sanitize_input($_POST["weight"]);
    $height = sanitize_input($_POST["height"]);
    $age = sanitize_input($_POST["age"]);
    $gender = sanitize_input($_POST["gender"]);
    $updateQuery = "UPDATE users SET weight = '$weight', height = '$height', age = '$age', gender = '$gender' WHERE id = $userId";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
} else {
    echo "Error: Invalid request";
}
?>

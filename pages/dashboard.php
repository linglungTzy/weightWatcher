<?php
include("../includes/db.php");
include("../includes/functions.php");
include("../includes/navbar.php");

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weeklyWeight = sanitize_input($_POST["weekly_weight"]);

    $query = "INSERT INTO weekly_weights (user_id, weight) VALUES ($userId, '$weeklyWeight')";
    
    if ($conn->query($query) === TRUE) {
        $success_message = "Weekly weight updated successfully";
    } else {
        $error_message = "Error updating weekly weight: " . $conn->error;
    }
}

$weeklyWeightsQuery = "SELECT id, week_start_date, weight FROM weekly_weights WHERE user_id = $userId ORDER BY week_start_date DESC";
$weeklyWeightsResult = $conn->query($weeklyWeightsQuery);

if (!$weeklyWeightsResult) {
    die("Error in SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dashboard - Weight Watcher</title>

</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Weight Watcher</h1>
        </div>
        <form action="dashboard.php" method="post">
            <label for="weekly_weight">Weekly Weight:</label>
            <input type="number" name="weekly_weight" required>
            <button type="submit">Update Weekly Weight</button>
        </form>

        <?php
        if (isset($success_message)) {
            echo "<p class='success'>$success_message</p>";
        } elseif (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }

        if ($weeklyWeightsResult->num_rows > 0) {
            echo "<h2>Weekly Progress</h2>";
            echo "<table>";
            echo "<tr><th>Time Stamp</th><th>Weight</th><th>Edit</th><th>Remove</th></tr>";

            while ($row = $weeklyWeightsResult->fetch_assoc()) {
                $weekStartDate = $row['week_start_date'];
                $weight = $row['weight'];
                $weeklyWeightId = $row['id'];

                echo "<tr>";
                echo "<td>$weekStartDate</td>";
                echo "<td>$weight kg</td>";
                echo "<td class='edit' onclick=\"editWeight($weeklyWeightId)\">Edit</td>";
                echo "<td class='remove' onclick=\"removeWeight($weeklyWeightId)\">Remove</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
        ?>
    </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function editWeight(weeklyWeightId) {
        var newWeight = prompt("Enter the new weight:");
        if (newWeight !== null) {
            $.post("edit_weight.php", { weekly_weight_id: weeklyWeightId, new_weight: newWeight }, function (response) {
                alert(response);
                location.reload();
            });
        }
    }

    function removeWeight(weeklyWeightId) {
        if (confirm("Are you sure you want to remove this weight?")) {
            $.post("remove_weight.php", { weekly_weight_id: weeklyWeightId }, function (response) {
                alert(response);
                location.reload();
            });
        }
    }
</script>

</body>
</html>





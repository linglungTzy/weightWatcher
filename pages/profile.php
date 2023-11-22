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
$userDataQuery = "SELECT * FROM users WHERE id = $userId";
$userDataResult = $conn->query($userDataQuery);

if ($userDataResult->num_rows > 0) {
    $userData = $userDataResult->fetch_assoc();
    $existingWeight = $userData['weight'];
    $existingHeight = $userData['height'];
    $existingAge = $userData['age'];
    $existingGender = $userData['gender'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weight = sanitize_input($_POST["weight"]);
    $height = sanitize_input($_POST["height"]);
    $age = sanitize_input($_POST["age"]);
    $gender = sanitize_input($_POST["gender"]);

    $updateQuery = "UPDATE users SET weight = '$weight', height = '$height', age = '$age', gender = '$gender' WHERE id = $userId";

    if ($conn->query($updateQuery) === TRUE) {
        $success_message = "Profile updated successfully";
    } else {
        $error_message = "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Profile - Weight Watcher</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Weight Watcher</h1>
        </div>
        <form id="profileForm">
            <label for="weight">Weight:</label>
            <input type="number" name="weight" id="weight" value="<?php echo isset($existingWeight) ? $existingWeight : ''; ?>" required>

            <label for="height">Height:</label>
            <input type="number" name="height" id="height" value="<?php echo isset($existingHeight) ? $existingHeight : ''; ?>" required>

            <label for="age">Age:</label>
            <input type="number" name="age" id="age" value="<?php echo isset($existingAge) ? $existingAge : ''; ?>" required>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="male" <?php echo (isset($existingGender) && $existingGender === 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (isset($existingGender) && $existingGender === 'female') ? 'selected' : ''; ?>>Female</option>
            </select>

            <button type="button" onclick="updateProfile()">Update Profile</button>
        </form>

        <div id="response"></div>

        <?php
        if (isset($success_message)) {
            echo "<p class='message'>$success_message</p>";
        } elseif (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
    </div>

    <script>
        function updateProfile() {
            var weight = $("#weight").val();
            var height = $("#height").val();
            var age = $("#age").val();
            var gender = $("#gender").val();

            $.ajax({
                type: "POST",
                url: "update_profile.php",
                data: { weight: weight, height: height, age: age, gender: gender },
                success: function(response) {
                    $("#response").html(response);
                }
            });
        }
    </script>
</body>
</html>
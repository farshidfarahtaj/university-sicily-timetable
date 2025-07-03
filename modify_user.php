<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = $_GET['id'];

// Fetch user details
$user_result = $conn->query("SELECT * FROM users WHERE id='$user_id'");
$user = $user_result->fetch_assoc();

// Handle user modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', role='$role' WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "User details updated successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify User - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<?php
// Include the left sidebar component
include 'LeftSidebar.php';
?>

<div>
    <header>
        <h1><img src="unilogo.png" alt="University Logo" width="161" height="149"></h1>
        <h1>University Of Sicily</h1>
        <h3>Admin Portal</h3>
        <h4 style="color: #EABEBF">Modify User</h4>
    </header>

    <main>
        <section>
            <div>
                <h3 align="center">Modify User Details</h3>
                <?php if (isset($message)) echo "<p>$message</p>"; ?>
                <form method="post" class="room-form">
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
                    
                    <label for="role">Role: </label>
                    <select name="role" id="role" required>
                        <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                    </select><br>
                    
                    <input type="submit" class="btn1" value="Update User">
                    <a href="manage_users.php"><input type="button" class="btn1" value="Back"></a>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
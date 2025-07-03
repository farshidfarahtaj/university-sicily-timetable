<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle admin registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_admin'])) {
    $username = $_POST['admin_username'];
    $password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);
    $role = 'admin';

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        $admin_message = "Admin registration successful.";
    } else {
        $admin_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle admin removal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_admin'])) {
    $admin_id = $_POST['admin_id'];

    $sql = "DELETE FROM users WHERE id='$admin_id' AND role='admin'";

    if ($conn->query($sql) === TRUE) {
        $remove_message = "Admin removal successful.";
    } else {
        $remove_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all admins
$admins = $conn->query("SELECT * FROM users WHERE role='admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
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
        <h4 style="color: #EABEBF">Manage Users</h4>
    </header>

    <main>
        <section class="center-section" align="center">
            <h2 align="center">Modify Users</h2>
            <a href="modify_students.php"><input type="button" class="btn1" value="Modify Students"></a>
            <a href="modify_admins.php"><input type="button" class="btn1" value="Modify Admins"></a>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
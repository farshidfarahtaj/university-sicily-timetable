<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: student_dashboard.php");
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="scripts.js" defer></script>
</head>
<body>

<?php
// Include the left sidebar component
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'LeftSidebar.php';
?>

<div >
    <header>
        <h1><img src="unilogo.png" alt="University Logo" width="161" height="149"></h1>
        <h1>University Of Sicily</h1>
    </header>
    <main>
        <form method="post" style="max-width:500px;margin:auto">
            <h2 style="text-align: center;">Login Form</h2>
            <div class="input-container">
                <i class="fa fa-user icon"></i>
                <input type="text" placeholder="Username" name="username" required>
            </div>

            <div class="input-container">
                <i class="fa fa-key icon"></i>
                <input type="password" placeholder="Password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
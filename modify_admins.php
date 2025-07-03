<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle admin registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    
    // Check if passwords match
    if ($password !== $retype_password) {
        $admin_message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'admin';

        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $admin_message = "Admin registration successful.";
        } else {
            $admin_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch all admin users
$admins = $conn->query("SELECT * FROM users WHERE role='admin'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Admins - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Manage Admins</h4>
    </header>

    <main>
        <section>
            <div>
                <h3 align="center">Register New Admin</h3>
                <?php if (isset($admin_message)) echo "<p>$admin_message</p>"; ?>
                <form method="post" class="room-form">
                    <h2 align="center">Register Form</h2>
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" required><br>
                    
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" required><br>
                    
                    <label for="retype_password">Re-type Password: </label>
                    <input type="password" name="retype_password" id="retype_password" required><br>
                    
                    <input type="hidden" name="register_admin" value="1">
                    <input type="submit" class="btn1" value="Register Admin">
                </form>
            </div>
        </section>

        <section>
            <h3 align="center">Modify Admin Users</h3>
            <div><p>
            <table>
                <tr>
                    <th height="67">Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php while ($admin = $admins->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($admin['username']); ?></td>
                    <td><?php echo htmlspecialchars($admin['role']); ?></td>
                    <td>
                        <a href="modify_user.php?id=<?php echo $admin['id']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $admin['id']; ?>" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            </p></div>
            
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
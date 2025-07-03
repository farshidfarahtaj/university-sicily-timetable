<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle student registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_student'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    
    // Check if passwords match
    if ($password !== $retype_password) {
        $student_message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'student';

        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $student_message = "Student registration successful.";
        } else {
            $student_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch all student users
$students = $conn->query("SELECT * FROM users WHERE role='student'");
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
            <h4 style="color: #EABEBF">Manage Subject</h4>
        </header>

        <main>
			<section>
			<p align="center"><div>
        <section>
            <div>
                <h3 align="center">Register New Student</h3>
                <?php if (isset($student_message)) echo "<p>$student_message</p>"; ?>
                <form method="post" class="room-form">
                    <h2 align="center">Register Form</h2>
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" required><br>
                    
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" required><br>
                    
                    <label for="retype_password">Re-type Password: </label>
                    <input type="password" name="retype_password" id="retype_password" required><br>
                    
                    <input type="hidden" name="register_student" value="1">
                    <input type="submit" class="btn1" value="Register">
                </form>
            </div>
        </section>

        <section>
            <h3 align="center">Modify Student Users</h3>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php while ($student = $students->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['username']); ?></td>
                    <td><?php echo htmlspecialchars($student['role']); ?></td>
                    <td>
                        <a href="modify_user.php?id=<?php echo $student['id']; ?>">Edit</a>
                        <a href="delete_user.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section>
				
				</p></div>
		</section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</body>
</html>
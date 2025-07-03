<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle course addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];

    $sql = "INSERT INTO courses (name, code) VALUES ('$name', '$code')";

    if ($conn->query($sql) === TRUE) {
        $message = "Course added successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle course deletion
if (isset($_GET['delete'])) {
    $course_id = $_GET['delete'];

    $sql = "DELETE FROM courses WHERE id='$course_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Course deleted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all courses
$courses = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Manage Course</h4>
    </header>

    <main>
        <section>
            <p align="center"><div>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
            
            <form method="post" class="room-form">
                <h2 align="center">Add New Course</h2>
                Course Name: <input type="text" name="name" required><br>
                Course Code: <input type="text" name="code" required><br>
                <input type="hidden" name="add_course" value="1">
                <input type="submit" class="btn1" value="Add Course">
            </form>

            <h2>Existing Courses</h2>
            <p><div>
            <table>
                <tr>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Actions</th>
                </tr>
                <?php while ($course = $courses->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $course['name']; ?></td>
                    <td><?php echo $course['code']; ?></td>
                    <td>
                        <a href="edit_course.php?id=<?php echo $course['id']; ?>">Edit</a>
                        <a href="manage_courses.php?delete=<?php echo $course['id']; ?>" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
            </div></p>
            </p></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
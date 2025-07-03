<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle timetable addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_timetable'])) {
    $room_id = $_POST['room_id'];
    $subject_id = $_POST['subject_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "INSERT INTO timetables (room_id, subject_id, day_of_week, start_time, end_time) VALUES ('$room_id', '$subject_id', '$day_of_week', '$start_time', '$end_time')";

    if ($conn->query($sql) === TRUE) {
        $message = "Timetable entry added successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle timetable deletion
if (isset($_GET['delete'])) {
    $timetable_id = $_GET['delete'];

    $sql = "DELETE FROM timetables WHERE id='$timetable_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Timetable entry deleted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all rooms and subjects for the dropdowns
$rooms = $conn->query("SELECT * FROM rooms");
$subjects = $conn->query("SELECT * FROM subjects");

// Fetch all timetables
$timetables = $conn->query("SELECT timetables.id, rooms.name AS room_name, subjects.name AS subject_name, courses.name AS course_name, timetables.day_of_week, timetables.start_time, timetables.end_time FROM timetables JOIN rooms ON timetables.room_id = rooms.id JOIN subjects ON timetables.subject_id = subjects.id JOIN courses ON subjects.course_id = courses.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Timetables - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Manage Timetables</h4>
    </header>

    <main>
        
        <section>
            <p align="center"><div>
            <section>
                <div>
                    <form method="post" class="room-form">
                        <h2 align="center">Add New Timetable Entry</h2>
                        
                        <label for="room_id">Room: </label>
                        <select name="room_id" id="room_id" required>
                            <?php while ($room = $rooms->fetch_assoc()): ?>
                                <option value="<?php echo $room['id']; ?>"><?php echo $room['name']; ?></option>
                            <?php endwhile; ?>
                        </select><br>
                        
                        <label for="subject_id">Subject: </label>
                        <select name="subject_id" id="subject_id" required>
                            <?php while ($subject = $subjects->fetch_assoc()): ?>
                                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                            <?php endwhile; ?>
                        </select><br>
                        
                        <label for="day_of_week">Day of Week: </label>
                        <select name="day_of_week" id="day_of_week" required>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select><br>
                        
                        <label for="start_time">Start Time: </label>
                        <input type="time" name="start_time" id="start_time" required><br>
                        
                        <label for="end_time">End Time: </label>
                        <input type="time" name="end_time" id="end_time" required><br>
                        
                        <input type="hidden" name="add_timetable" value="1">
                        <input type="submit" class="btn1" value="Add Timetable Entry">
                    </form>
                </div>
            </section>

            <section>
                <h2>Existing Timetables</h2>
                <table>
                    <tr>
                        <th>Room Name</th>
                        <th>Subject Name</th>
                        <th>Course Name</th>
                        <th>Day of Week</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($timetable = $timetables->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $timetable['room_name']; ?></td>
                        <td><?php echo $timetable['subject_name']; ?></td>
                        <td><?php echo $timetable['course_name']; ?></td>
                        <td><?php echo $timetable['day_of_week']; ?></td>
                        <td><?php echo $timetable['start_time']; ?></td>
                        <td><?php echo $timetable['end_time']; ?></td>
                        <td>
                            <a href="edit_timetable.php?id=<?php echo $timetable['id']; ?>">Edit</a>
                            <a href="manage_timetables.php?delete=<?php echo $timetable['id']; ?>" onclick="return confirm('Are you sure you want to delete this timetable entry?');">Delete</a>
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
</div>
</body>
</html>
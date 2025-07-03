<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$timetable_id = $_GET['id'];

// Fetch timetable details
$timetable_result = $conn->query("SELECT * FROM timetables WHERE id='$timetable_id'");
$timetable = $timetable_result->fetch_assoc();

// Fetch all rooms and subjects for the dropdowns
$rooms = $conn->query("SELECT * FROM rooms");
$subjects = $conn->query("SELECT * FROM subjects");

// Handle timetable modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $subject_id = $_POST['subject_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "UPDATE timetables SET room_id='$room_id', subject_id='$subject_id', day_of_week='$day_of_week', start_time='$start_time', end_time='$end_time' WHERE id='$timetable_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Timetable details updated successfully.";
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
    <title>Edit Timetable - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Edit Timetable</h4>
    </header>

    <main>
        <section>
            <div>
                <form method="post" class="room-form">
                    <h2 align="center">Edit Timetable Details</h2>
                    <?php if (isset($message)) echo "<p>$message</p>"; ?>
                    
                    <label for="room_id">Room: </label>
                    <select name="room_id" id="room_id" required>
                        <?php while ($room = $rooms->fetch_assoc()): ?>
                            <option value="<?php echo $room['id']; ?>" <?php if ($room['id'] == $timetable['room_id']) echo 'selected'; ?>><?php echo $room['name']; ?></option>
                        <?php endwhile; ?>
                    </select><br>
                    
                    <label for="subject_id">Subject: </label>
                    <select name="subject_id" id="subject_id" required>
                        <?php while ($subject = $subjects->fetch_assoc()): ?>
                            <option value="<?php echo $subject['id']; ?>" <?php if ($subject['id'] == $timetable['subject_id']) echo 'selected'; ?>><?php echo $subject['name']; ?></option>
                        <?php endwhile; ?>
                    </select><br>
                    
                    <label for="day_of_week">Day of Week: </label>
                    <select name="day_of_week" id="day_of_week" required>
                        <option value="Monday" <?php if ($timetable['day_of_week'] == 'Monday') echo 'selected'; ?>>Monday</option>
                        <option value="Tuesday" <?php if ($timetable['day_of_week'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                        <option value="Wednesday" <?php if ($timetable['day_of_week'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                        <option value="Thursday" <?php if ($timetable['day_of_week'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                        <option value="Friday" <?php if ($timetable['day_of_week'] == 'Friday') echo 'selected'; ?>>Friday</option>
                    </select><br>
                    
                    <label for="start_time">Start Time: </label>
                    <input type="time" name="start_time" id="start_time" value="<?php echo $timetable['start_time']; ?>" required><br>
                    
                    <label for="end_time">End Time: </label>
                    <input type="time" name="end_time" id="end_time" value="<?php echo $timetable['end_time']; ?>" required><br>
                    
                    <input type="submit" class="btn1" value="Update Timetable">
                    <a href="manage_timetables.php"><input type="button" class="btn1" value="Back"></a>
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
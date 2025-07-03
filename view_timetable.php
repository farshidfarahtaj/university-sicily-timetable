<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
}

$sql = "SELECT subjects.name AS subject_name, rooms.name AS room_name, timetables.day_of_week, timetables.start_time, timetables.end_time 
        FROM timetables 
        JOIN subjects ON timetables.subject_id = subjects.id 
        JOIN rooms ON timetables.room_id = rooms.id 
        ORDER BY timetables.day_of_week, timetables.start_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Timetable - University Of Sicily</title>
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
        <h3>Student Portal</h3>
    </header>

    <main>
        <table>
            <tr>
                <th>Subject</th>
                <th>Room</th>
                <th>Day of Week</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['subject_name']; ?></td>
                <td><?php echo $row['room_name']; ?></td>
                <td><?php echo $row['day_of_week']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$room_id = $_GET['id'];

// Fetch room details
$room_result = $conn->query("SELECT * FROM rooms WHERE id='$room_id'");
$room = $room_result->fetch_assoc();

// Handle room modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE rooms SET name='$name', capacity='$capacity' WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Room details updated successfully.";
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
    <title>Edit Room - University Of Sicily</title>
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
        <h4 style="color: #EABEBF">Edit Rooms</h4>
    </header>

    <main>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        <section>
            <p align="center"><div>
        
        <form method="post" class="room-form">
            <h2 align="center">Update Room</h2>
            Room Name: <input name="name" type="text" value="<?php echo $room['name']; ?>" required><br>
            Capacity: <input type="number" name="capacity" value="<?php echo $room['capacity']; ?>" required><br>
            <input type="hidden" name="add_room" value="1">
            <input type="submit" class="btn1" value="Update Room">
            <a href="manage_courses.php"><input type="button" class="btn1" value="Back"></a>
        </form>
            </p></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
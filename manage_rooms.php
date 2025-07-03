<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle room addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_room'])) {
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO rooms (name, capacity) VALUES ('$name', '$capacity')";

    if ($conn->query($sql) === TRUE) {
        $message = "Room added successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle room deletion
if (isset($_GET['delete'])) {
    $room_id = $_GET['delete'];

    $sql = "DELETE FROM rooms WHERE id='$room_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Room deleted successfully.";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all rooms
$rooms = $conn->query("SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms - University Of Sicily</title>
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
            <h4 style="color: #EABEBF">Manage Rooms</h4>
        </header>

        <main>
            <?php if (isset($message))
                echo "<div class='success-popup'>$message</div>"; ?>
            <section>
                <p align="center">
                <div>
                    <form method="post" class="room-form">
                        <h2 align="center">Add New Room</h2>
                        Room Name: <input name="name" type="text" required><br>
                        Capacity: <input type="number" name="capacity" required><br>
                        <input type="hidden" name="add_room" value="1">
                        <input type="submit" class="btn1" value="Add Room">
                    </form>

                    <h2 align="center">Existing Rooms</h2>
                    <div>
                        <p>

                        <table>
                            <tr>
                                <th height="20">Room Name</th>
                                <th>Capacity</th>
                                <th>Actions</th>
                            </tr>
                            <?php while ($room = $rooms->fetch_assoc()): ?>
                                <tr>
                                    <td height="20"><?php echo $room['name']; ?></td>
                                    <td><?php echo $room['capacity']; ?></td>
                                    <td>
                                        <a href="edit_room.php?id=<?php echo $room['id']; ?>">Edit</a>
                                        <a href="manage_rooms.php?delete=<?php echo $room['id']; ?>"
                                            onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                        </p>
                    </div>
                    </p>
                </div>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
        </footer>
    </div>

</body>

</html>
<?php
include 'db.php';
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - University Of Sicily</title>
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
        <div class="welcome">
            <p><strong><h2>Welcome, <?php echo $_SESSION['username']; ?></h2></strong> 
            <p>We are thrilled to have you here. This is your personal space to access all the tools, resources, and information you need to succeed in your academic journey. Stay up to date with your courses, assignments, grades, and more. We're here to support you every step of the way.
            </p>
            <p>&nbsp;</p>
            <p>Feel free to explore and make the most of your student portal experience!</p>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
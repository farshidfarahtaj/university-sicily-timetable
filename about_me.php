<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us - University Of Sicily</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="left-sidebar.css">
    <script src="scripts.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <?php
    // Include the left sidebar component
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include 'LeftSidebar.php';
    ?>

    <div>
        <header>
            <h1><img src="unilogo.png" alt="University Logo" width="161" height="149"></h1>
            <h1>University Of Sicily</h1>
        </header>

        <main>
            <section>
                <p align="center">
                <div>
                    <section>
                        <h2>Who We Are</h2>
                        <p>We are Farshid and Farsad, passionate tech enthusiasts and final-year students at the
                            University of Messina. With a shared interest in building practical solutions using modern
                            web technologies, we teamed up to develop this platform.</p>
                    </section>

                    <section>
                        <h2>About This Project</h2>
                        <p>This project is a comprehensive web portal designed to efficiently manage university class
                            timetables. It ensures room availability, considers maximum capacity, and integrates various
                            subjects and courses. The portal includes:</p>
                        <p>User Registration and Login:</p>
                        <ul>
                            <li>Secure authentication for users.</li>
                        </ul>
                        <p>Timetable Management:</p>
                        <ul>
                            <li> Administrators can add, remove, and modify timetables.</li>
                        </ul>
                        <p> Student View:</p>
                        <ul>
                            <li> Students can view their course timetables in a read-only format.</li>
                        </ul>
                        <p> Backend Development:</p>
                        <ul>
                            <li> Using PHP and MySQL to provide robust APIs.</li>
                        </ul>
                        <p> Frontend Development:</p>
                        <ul>
                            <li> Built with HTML, CSS, and Angular.js for a dynamic user experience.</li>
                        </ul>
                    </section>
                    <div class="icon-container">
                        <h3>Farshid Farahtaj</h3>
                        <a href="https://www.linkedin.com/in/farshidfarahtaj/" class="fa fa-linkedin"></a>
                        <a href="https://www.instagram.com/farshidfarahtaj.ff/" class="fa fa-instagram"></a>
                    </div>
                    <div class="icon-container">
                        <h3>Farsad Ghane Kia</h3>
                        <a href="https://www.linkedin.com/in/farsad-ghane-kia/" class="fa fa-linkedin"></a>
                        <a href="https://www.instagram.com/farrsad/" class="fa fa-instagram"></a>
                    </div>
                </div>
                </p>
            </section>
        </main>
        <footer>
            <p>&copy; 2025 University Of Sicily. All rights reserved.</p>
        </footer>
    </div>

</body>

</html>
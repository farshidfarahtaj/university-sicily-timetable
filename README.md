# University of Sicily

This project is a web-based University Management System for the University of Sicily. It provides a platform for managing class timetables, user registrations, and administrative tasks for both students and administrators.

## Features
- User registration and login (admin and student roles)
- Admin dashboard for managing courses, rooms, subjects, timetables, and users
- Student dashboard for viewing timetables
- Secure authentication and session management
- Responsive sidebar navigation
- CRUD operations for courses, rooms, subjects, and timetables
- User management (add, edit, delete users)

## Technologies Used
- PHP (backend logic)
- MySQL (database)
- HTML, CSS, JavaScript (frontend)

## Setup Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/university-sicily.git
   ```
2. Import the MySQL database (see `db.php` for connection details).
3. Place the project files in your web server directory (e.g., `htdocs` for XAMPP).
4. Update database credentials in `db.php` as needed.
5. Access the application via your local server (e.g., `http://localhost/university-sicily`).

## Project Structure
- `index.php` - Home page
- `login.php`, `register.php`, `logout.php` - Authentication
- `admin_dashboard.php`, `student_dashboard.php` - Dashboards
- `manage_courses.php`, `manage_rooms.php`, `manage_subjects.php`, `manage_timetables.php`, `manage_users.php` - Admin management pages
- `edit_course.php`, `edit_room.php`, `edit_subject.php`, `edit_timetable.php`, `modify_admins.php`, `modify_students.php`, `modify_user.php`, `delete_user.php` - Edit/Delete pages
- `about_me.php` - About the project and creators
- `LeftSidebar.php` - Sidebar component
- `db.php` - Database connection
- `User.php` - User class
- `style.css`, `left-sidebar.css`, `sidebar.css` - Stylesheets
- `scripts.js` - JavaScript functionality
- `unilogo.png` - University logo

## Authors
- Farshid
- Farsad

## License
This project is for educational purposes.

# dgl104_group1_tm

# Task Management System - Project Documentation

## Project Overview
## Project Description
The Task Management System is a web-based PHP and MySQL program designed to simplify the creation, assignment, and tracking of the tasks in a team or an organization. The system provides a seamless and efficient way of managing the distribution of the workload, the tracking on the tasks, and the improvement in the overall productivity.

As the need grows for web-based collaboration and coordination on tasks, the project will have a real-world solution that will be deployable in project-based organizations, school districts, or small groups. The system allows administrators to control roles for users, assign and create tasks, and track project action through a centralized console.

Furthermore, the software incorporates standard aspects such as user login, notification for tasks, and access control by role in order to provide safe and reliable operation. The backend is supported by a relational MySQL database in order to ensure data integrity and consistency.

The assignment was done in the form of a group assignment to reflect real team working and code control. Assuming correct code control and team working, the project reflects simple software engineering principles.

---

## Team Members
- George Akaeze
- Tien Pham
- Abdulbasit Aawofeso

---

## Objectives
- Develop a reliable and user-friendly task management system.
- Implement core features such as task creation, user authentication, and task assignment.
- Use a relational database (MySQL) for efficient data storage and retrieval.
- Apply best practices in web development using PHP and structured backend logic.

---

## Technologies Used
- **Frontend**: The user interface of the application is built using HTML and CSS. Bootstrap, a popular front-end toolkit, is used to provide a responsive and visually appealing design with minimal custom styling effort.

- **Backend**: PHP is used as the server-side scripting language to handle all the application logic. Core PHP is utilized without relying on any external frameworks, which ensures complete control over the application's behavior and structure.

- **Database**: MySQL serves as the relational database management system for storing user information, task details, and assignment records. It supports efficient data retrieval, relational integrity, and scalability.

- **Development Tools**: XAMPP is employed as the local development environment. It provides an integrated package that includes Apache (web server) and MySQL (database), making it easy to simulate a live server on a local machine. phpMyAdmin is used as a graphical interface to interact with the MySQL database.

- **Version Control**: Git is used to manage changes in the source code and enable collaborative development. The project repository tracks the history of contributions and allows team members to work on different parts of the project simultaneously without conflict.

---

## Team Collaboration
This project was developed by a group of three students who worked collaboratively. Each team member contributed to different aspects of the system including UI design, backend logic, database design, and testing. Tasks were distributed among members to ensure the smooth progress and version control was used to manage changes and avoid conflicts.

---

## System Features

### 1. User Authentication
- Login and logout functionality.
- Secure user sessions.
- Role-based access control (admin and regular users).

### 2. User Management
- Admins can add, edit, or delete users.
- Profile editing capability for all users.

### 3. Task Management
- Create, update, and delete tasks.
- Assign tasks to specific users.
- Edit task information and reassign as needed.
- Users can view their assigned tasks.

### 4. Notifications
- Basic in-system notifications to alert users of assigned tasks or changes.

### 5. Dashboard
- A central location for users to view assigned tasks.
- Admin can view all tasks and users in the system.

---

## Database Structure
The application uses MySQL as its database management system. The structure includes several relational tables to store and link data efficiently:

- **Users Table**: Stores user credentials and profile information.
- **Tasks Table**: Stores task data, including status and assignee.
- **Task Assignments Table**: Links users with tasks.

The database schema is defined in the `task_management_db.sql` file, which can be imported into phpMyAdmin to initialize the system.

---

## File Structure Summary

| File | Purpose |
|------|---------|
| `index.php` | Main dashboard for logged-in users |
| `login.php` | User login page |
| `logout.php` | Handles session termination |
| `add-user.php` | Allows admin to create new users |
| `edit-user.php` / `delete-user.php` | Modify or remove user accounts |
| `create_task.php` | Interface for task creation |
| `edit-task.php` / `delete-task.php` | Manage task details |
| `my_task.php` | Allows users to view their assigned tasks |
| `notifications.php` | Displays system notifications |
| `DB_connection.php` | Contains database connection logic |
| `task_management_db.sql` | SQL script to set up the database |

---

## Testing Environment
The application was developed and tested locally using the XAMPP stack, which includes Apache server and MySQL database. The system is fully functional in modern browsers such as Google Chrome and Mozilla Firefox.

---

## Conclusion
This Task Management System is an operational demonstration of web development principles, database integration, and collaborative software engineering. It is a basis platform for task management, team organization, and responsibility coordination in an organized and usable way.

The project demonstrates the power of combining backend logic with database access and user-friendly interface to address typical productivity needs in any collaborative environment. It demonstrates how collaborative development, version control, and modular programming can be translated into an extensible and maintainable web application.

Although the current iteration introduces essential features needed for task tracking, it also sets the stage for potential future enhancements. Some of these include integration of real-time notifications, integration of calendar APIs, inclusion of task priority and deadlines, extensions of user role and permissions, and UI/UX design enhancements to further simplify user interaction.

Generally speaking, this system is a prototype and a learning system that reflects good technical work and teamwork. It can be a good foundation for more sophisticated project management systems in the future.


# 🎓 University Management System (UMS)

A comprehensive web-based student management system for **Khwaja Yunus Ali University (KYAU)**. This application provides an intuitive interface for managing students, courses, enrollments, and grades.

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=flat-square&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 📑 Table of Contents

- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Database Setup](#-database-setup)
- [Configuration](#%EF%B8%8F-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Technologies Used](#️-technologies-used)
- [Features in Detail](#-features-in-detail)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

## 🎯 Features

- 👥 **Student Management**: Add, edit, delete, and view student records with enrollment years
- 📚 **Course Management**: Create and manage courses with credit values
- 🔗 **Enrollment Management**: Link students to their enrolled courses
- ⭐ **Grade Management**: Record and manage student grades for each course
- 📊 **Student Reports**: Generate comprehensive grade reports with filtering capabilities
- 📱 **Responsive Design**: Modern, mobile-friendly interface with a clean UI
- 🏠 **Dashboard**: Centralized dashboard with quick access to all modules

## 💻 Requirements

- **PHP**: Version 7.4 or higher
- **MySQL**: Version 5.7 or higher (or MariaDB 10.3+)
- **Web Server**: Apache (via XAMPP, WAMP, or LAMP) or Nginx
- **Browser**: Modern web browser (Chrome, Firefox, Edge, Safari)

## 🚀 Installation

### 📥 Step 1: Clone or Download the Project

```bash
# If using git
git clone <repository-url>
cd student

# Or download and extract to your web server directory
# For XAMPP: C:\xampp\htdocs\student
# For WAMP: C:\wamp64\www\student
# For LAMP: /var/www/html/student
```

### ⚙️ Step 2: Configure Database

1. Open `config/db.php` and update the database credentials if needed:
```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "university";
```

### 🗄️ Step 3: Create Database

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Create a new database named `university`
3. Import the SQL schema (see [Database Setup](#-database-setup) below)

### ▶️ Step 4: Start Web Server

- **XAMPP**: Start Apache and MySQL from the XAMPP Control Panel
- **WAMP**: Start all services from the WAMP menu
- **LAMP**: Start Apache and MySQL services

### 🌐 Step 5: Access the Application

Open your browser and navigate to:
```
http://localhost/student
```

## 🗄️ Database Setup

### 📦 Create Database

```sql
CREATE DATABASE IF NOT EXISTS university;
USE university;
```

### 📋 Create Tables

```sql
-- Students table
CREATE TABLE IF NOT EXISTS student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    enrollment_year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Courses table
CREATE TABLE IF NOT EXISTS course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    credits INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Enrollments table
CREATE TABLE IF NOT EXISTS enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATE DEFAULT (CURRENT_DATE),
    FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES course(course_id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (student_id, course_id)
);

-- Grades table
CREATE TABLE IF NOT EXISTS grade (
    grade_id INT AUTO_INCREMENT PRIMARY KEY,
    enrollment_id INT NOT NULL,
    grade VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enrollment_id) REFERENCES enrollment(enrollment_id) ON DELETE CASCADE
);
```

### 📝 Sample Data (Optional)

```sql
-- Insert sample students
INSERT INTO student (student_name, enrollment_year) VALUES
('John Doe', 2020),
('Jane Smith', 2021),
('Bob Johnson', 2020);

-- Insert sample courses
INSERT INTO course (course_name, credits) VALUES
('Introduction to Computer Science', 3),
('Database Management', 4),
('Web Development', 3);

-- Insert sample enrollments
INSERT INTO enrollment (student_id, course_id) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3);

-- Insert sample grades
INSERT INTO grade (enrollment_id, grade) VALUES
(1, 'A'),
(2, 'B+'),
(3, 'A-'),
(4, 'B');
```

## ⚙️ Configuration

### 🔐 Database Configuration

Edit `config/db.php` to match your database settings:

```php
$host = "localhost";    // Database host
$user = "root";         // Database username
$pass = "";             // Database password
$db   = "university";   // Database name
```

### 🔗 Base URL Configuration

If your application is not in the root directory, update the base URL in `includes/header.php`:

```php
$baseUrl = '/student';  // Change to match your installation path
```

## 📖 Usage

### 🏠 Dashboard

The main dashboard provides quick access to all modules:
- 👥 **Students**: Manage student records
- 📚 **Courses**: Manage course information
- 🔗 **Enrollments**: Link students to courses
- ⭐ **Grades**: Record student grades
- 📊 **Reports**: View student grade reports

### 👥 Managing Students

1. Navigate to **Students** from the dashboard
2. Click **Add Student** to create a new student
3. Fill in the student name and enrollment year
4. Use **Edit** or **Delete** buttons to manage existing students

### 📚 Managing Courses

1. Navigate to **Courses** from the dashboard
2. Click **Add Course** to create a new course
3. Enter the course name and credit value (1-10)
4. Manage existing courses using **Edit** or **Delete** buttons

### 🔗 Managing Enrollments

1. Navigate to **Enrollments** from the dashboard
2. Click **Add Enrollment** to enroll a student in a course
3. Select a student and course from the dropdown menus
4. Students can be enrolled in multiple courses

### ⭐ Managing Grades

1. Navigate to **Grades** from the dashboard
2. Click **Add Grade** to record a grade
3. Select an enrollment (student-course combination)
4. Enter the grade value (e.g., A, B+, C, etc.)

### 📊 Viewing Reports

1. Navigate to **Student Grade Report** from the dashboard
2. Optionally filter by student name
3. View all student grades with course information and credits

## 📁 Project Structure

```
student/
├── assets/                  # Static assets (images, logos)
│   └── kyau-logo.png       # University logo
├── config/                  # Configuration files
│   └── db.php              # Database configuration
├── course/                  # Course management module
│   ├── create.php          # Create new course
│   ├── edit.php            # Edit existing course
│   ├── delete.php          # Delete course
│   └── index.php           # List all courses
├── enrollment/              # Enrollment management module
│   ├── create.php          # Create new enrollment
│   ├── edit.php            # Edit existing enrollment
│   ├── delete.php          # Delete enrollment
│   └── index.php           # List all enrollments
├── grade/                   # Grade management module
│   ├── create.php          # Create new grade
│   ├── edit.php            # Edit existing grade
│   ├── delete.php          # Delete grade
│   └── index.php           # List all grades
├── includes/                # Shared components
│   ├── header.php          # Header template with navigation
│   ├── footer.php          # Footer template
│   └── functions.php       # Helper functions
├── report/                  # Reports module
│   └── student_report.php  # Student grade report
├── student/                 # Student management module
│   ├── create.php          # Create new student
│   ├── edit.php            # Edit existing student
│   ├── delete.php          # Delete student
│   └── index.php           # List all students
├── index.php                # Main dashboard
└── README.md                # Project documentation
```

## 🛠️ Technologies Used

- 💻 **Backend**: PHP 7.4+
- 🗄️ **Database**: MySQL 5.7+
- 🎨 **Frontend**: HTML5, CSS3, JavaScript
- 🎭 **Styling**: Custom CSS with modern design principles
- 🏗️ **Architecture**: MVC-inspired structure

## 🎨 Features in Detail

### 🔒 Security Features

- 🛡️ SQL injection prevention using `mysqli_real_escape_string()`
- 🔐 XSS prevention using `htmlspecialchars()`
- ✅ Input validation on all forms
- 🔒 CSRF protection considerations

### 🎨 User Interface

- 📱 Responsive design that works on desktop, tablet, and mobile
- 🎭 Clean, modern interface with gradient headers
- 🧭 Intuitive navigation with sidebar menu
- 🎨 Color-coded alerts for success, error, and warning messages
- ⚠️ Confirmation dialogs for delete operations

### 🗄️ Database Design

- 📊 Normalized database structure
- 🔗 Foreign key constraints for data integrity
- 🗑️ Cascade deletes to maintain referential integrity
- 🔒 Unique constraints to prevent duplicate enrollments

## 🔍 Troubleshooting

### ⚠️ Common Issues

1. **🔌 Database Connection Error**
   - Verify MySQL is running
   - Check database credentials in `config/db.php`
   - Ensure the database `university` exists

2. **❌ Page Not Found (404)**
   - Verify the base URL in `includes/header.php`
   - Check Apache/Nginx configuration
   - Ensure mod_rewrite is enabled (if using pretty URLs)

3. **🚫 Permission Denied**
   - Check file permissions on the project directory
   - Ensure the web server has read access to all files

4. **🎨 CSS/Images Not Loading**
   - Verify the `assets` directory exists
   - Check file paths in `header.php`
   - Clear browser cache

## 📝 Notes

- 📌 This is a basic CRUD application suitable for learning and small-scale deployments
- 🚀 For production use, consider adding:
  - 👤 User authentication and authorization
  - 🔐 Password hashing
  - 🛡️ Prepared statements (PDO) for better security
  - 🧹 Input sanitization libraries
  - 🔌 API endpoints
  - 📋 Logging and error handling
  - 💾 Backup and recovery mechanisms

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. 🍴 Fork the repository
2. 🌿 Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. 💾 Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. 📤 Push to the branch (`git push origin feature/AmazingFeature`)
5. 🔄 Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Author

**👩‍🎓 Developed by:** *Umme Salma*  
**🎓 Batch:** 16th  
**💻 Department:** Computer Science and Engineering (CSE)  
**🏛️ Developed for:** *Khwaja Yunus Ali University (KYAU)*

---

## 📞 Support

For support, please open an issue in the repository or contact the development team.

---

<div align="center">

**Made with ❤️ for Khwaja Yunus Ali University**

⭐ Star this repo if you find it helpful!

</div>

---

**Version**: 1.0.0  
**Last Updated**: 2025  
**Status**: Active Development


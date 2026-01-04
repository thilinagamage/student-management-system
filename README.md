# Student Management System

A role-based Student Management System with Laravel 10, featuring enrollment workflows, attendance tracking, and export-ready reporting. Designed with real academic institution process in mind.

## ✨ Features

### 🔐 Authentication & Roles
- **User Roles**: Admin, Teacher, Student
- Secure login & logout system
- Role-based access control using middleware

### 👨‍🎓 Student Management
- Create, read, update, and delete student records
- Store personal and academic information
- Assign students to courses and batches
- Student profile management

### 📚 Course & Batch Management
- Create and manage academic programs/courses
- Create batches linked to specific courses
- Generate batch codes and manage academic timelines

### 📝 Student Enrollment
- Enroll students into one or multiple batches
- Prevent duplicate enrollments
- View enrolled batches per student
- Enrollment tracking system

### 👨‍🏫 Teacher Management
- Manage teacher profiles
- Assign teachers to courses and batches

### ✅ Attendance Management
##### Student Attendance
- Mark daily attendance per batch
- Present / Absent / /Leave status
- Attendance history tracking
  
##### Teacher Attendance
- Admin can mark teacher attendance
- Teacher can mark thier attendance
- Generate attendance reports

### 🛡️ Admin Dashboard
- Student Count, Teacher Count, Batches Count, Attendance Count


## 🛠️ Technologies Used

- **Java** (Core Java, Collections Framework, File I/O)
- **Object-Oriented Programming** principles
- **File-based data storage** (text files)
- **Console-based user interface**

## 📋 Prerequisites

- Java Development Kit (JDK) 8 or higher
- Any Java IDE (Eclipse, IntelliJ IDEA, VS Code) or command line

## 🚀 Installation & Setup

### Method 1: Using an IDE
1. Clone the repository or download the source code
2. Open the project in your preferred Java IDE
3. Ensure JDK is properly configured
4. Locate the main class (typically `Main.java` or `Application.java`)
5. Run the application

### Method 2: Using Command Line
```bash
# Clone the repository
git clone https://github.com/thilinagamage/student-management-system.git

# Navigate to project directory
cd student-management-system

# Compile the Java files
javac -d bin src/**/*.java

# Run the application
java -cp bin Main

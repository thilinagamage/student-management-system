# Student Management System

A simple Java-based console application for managing student records with file-based data persistence.

## Features

- **Authenticarion & Roles**:
  Admin, Teacher, Student user roles
  Secure login & logout
  Rolebased access using middleware
  
- **Student Management**:
- Create, Update, View and Delete students
- Store personal and academic information
- Assign students to course and batches
- Student profile management
 
- **Course & Batch Management**:
- Create and manage course / programs
- Create batches linked to course
- Batch codes and academic timelines
  
- **Student Enrollment Module**:
-  Enroll student into one or multiple batches
-  Prevent duplicate enrollments
-  view enrolled batches per student
-  Enrollment tracking
    
- **Teacher Management**:
- Manage teacher profiiles
- Assdign teachers to course / batches
  
- *Attendance Management*:
- 
- 
- **Input Validation**: Robust error handling for user inputs

## Technologies Used

- Java (Core Java, Collections Framework, File I/O)
- Object-Oriented Programming principles
- File-based data storage (text file)

## Prerequisites

- Java Development Kit (JDK) 8 or higher
- Any Java IDE (Eclipse, IntelliJ IDEA, VS Code) or command line

## Installation

    git clone https://github.com/thilinagamage/student-management-system.git
    cd student-management-system
    
    composer install
    npm install && npm run build
    
    cp .env.example .env
    php artisan key:generate
    
    php artisan db:seed --class=SuperAdminSeeder
    php artisan db:seed --class=PermissionSeeder
    php artisan serve


## Demo Admin Account

    Email : superadmin@system.com
    password: password

## 👨‍💻 Author

Thilina Gamage
Laravel & WordPress Developer
📍 Sri Lanka

GitHub: https://github.com/thilinagamage



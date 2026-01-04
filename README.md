# Student Management System

A simple Java-based console application for managing student records with file-based data persistence.

## Features

- **Add Student**: Create new student records with name, ID, age, and grade
- **View Students**: Display all registered students in a formatted table
- **Update Student**: Modify existing student information
- **Delete Student**: Remove student records from the system
- **Data Persistence**: All student data is automatically saved to and loaded from a text file
- **Search Functionality**: Find students by their unique ID
- **Input Validation**: Robust error handling for user inputs

## Technologies Used

- Java (Core Java, Collections Framework, File I/O)
- Object-Oriented Programming principles
- File-based data storage (text file)

## Prerequisites

- Java Development Kit (JDK) 8 or higher
- Any Java IDE (Eclipse, IntelliJ IDEA, VS Code) or command line

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/thilinagamage/student-management-system.git
    git clone https://github.com/your-username/student-management-system.git
    cd student-management-system
    
    composer install
    npm install && npm run build
    
    cp .env.example .env
    php artisan key:generate
    
    php artisan db:seed --class=SuperAdminSeeder
    php artisan db:seed --class=PermissionSeeder
    php artisan serve

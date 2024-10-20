# Todo - Task Manager

A simple Todo List application built using **PHP**, **MySQL**, **HTML/CSS**, **JS** and **Bootstrap** for styling.

## Key Features

1. **User Authentication**
    - Register and login to manage your personal todo list.
    - Password encryption for security.
    - Password Reset view email.
      
2. **Task Management**
   - Add, edit, and delete tasks.
   - Mark tasks as completed or incomplet.
   - Organize tasks with categories.

3. **Sorting and Filtering**
   - Sort tasks by priority, due date, or status.
   - Filter tasks by categories and completion status.

4. **Search for Tasks**
   - Search for tasks by titles or description.

5. **Task due date Notification**
   - Get notification for overdue or upcoming tasks.

6. **Responsive Design**
   - Mobile-Friendly interface.


## Installation

To use rest password by email functionality, We need PHPMailer in the project, you need to install it via Composer.

### Step 1: Install PHPMailer

Run the following command in your project directory:

```bash
composer require phpmailer/phpmailer

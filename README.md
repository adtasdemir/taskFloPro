# TaskFlowPro

TaskFlowPro is a project management tool built with Laravel, Docker, MySQL, and Blade with TailwindCSS. It provides functionalities to manage projects and tasks, and includes API endpoints documented with Swagger. Postman collection files are also included for testing.

## Features
- Dockerized environment with Laravel and MySQL
- TailwindCSS for styling
- Blade templates for frontend views
- RESTful API for managing projects and tasks
- Swagger API documentation
- Postman collection for easy API testing

## Overview of the project.

#### 1 The project involves user management with functionality for login, registration, updates, and deletion of user. The dashboard page displays a list of tasks in a table format, with options to list, delete, and edit tasks. There is also a button to add new projects.

#### 2 When you click on "List Tasks," you are redirected to the tasks/list page, where you can view a table of tasks related to each project. On this page, you can delete or edit individual tasks and add new tasks to the respective projects.

#### 3 The entire application is designed to be responsive, ensuring a seamless experience across different devices.

## Setup

### Prerequisites
Ensure you have the following installed on your local machine:
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Node.js](https://nodejs.org/en/download/) and npm
- [Composer](https://getcomposer.org/download/)

### 1. Clone the Repository

git clone https://github.com/adtasdemir/taskFloPro.git
cd taskFloPro

### 2. Environment Configuration
cp .env.example .env
Update the following values in the .env file:

DB_DATABASE=flowTask
DB_USERNAME=root
DB_PASSWORD=root

### 3. Install Dependencies
Install PHP dependencies using Composer:

composer install

Install JavaScript dependencies using npm:

npm install

### 4. Build Frontend Assets
Using Vite, build or serve your frontend assets:

npm run dev  # for development
npm run build  # for production

### 5 Set Up Docker Containers
Start the Docker containers (Laravel, MySQL, Nginx):

docker-compose up -d

### 6. Run Migrations
Run the database migrations to create the necessary tables:

docker exec -it app-container-name php artisan migrate

### 7. Access the Application
Once everything is set up, you can access the application at:

Frontend: http://localhost/
API Documentation (Swagger): http://localhost/api/documentation

### 8. Testing with Postman
To test the API endpoints, you can import the Postman  [collection](https://github.com/adtasdemir/taskFloPro/blob/main/postman_collection.json) provided in the repository.



## Explanation of the design pattern 

### 1 The code implements the Repository Pattern, the Service Pattern.
#### 1 Repository Pattern:
The BaseRepository, TasksRepository and ProjectsRepository  classes encapsulate the data access logic. The repositories provide an abstraction layer between the application and the database, making it easier to manage and test the data interactions. This pattern is used to handle all database operations in a structured and reusable way, allowing the service layer to focus on business logic rather than direct database access.

#### 2 Service Pattern:
The BaseService, ProjectsService and TasksService class handles the business logic of the application. It calls the repository to fetch or modify data and processes it as required. The service layer typically orchestrates multiple repositories or performs additional operations, ensuring separation of concerns between business logic and data access. This pattern ensures that business rules are applied consistently and provides a place for logic that doesn't belong in the repository.


### 2 Response Classes and Request Classes

I used Response Classes and Request Classes to align with clean architecture principles and best practices by ensuring separation of concerns.

#### 1 Request Classes:
These classes handle the validation and sanitization of incoming requests. By using them, you ensure that the data entering your application is clean and validated at the entry point.
Laravel's FormRequest is a great tool for centralizing validation logic, making your controllers cleaner and more focused on application flow.

#### 2 Response Classes:
These classes help format responses consistently across the application. Instead of directly returning arrays or JSON, you use a response helper that formats data, sets status codes, and manages additional metadata like pagination.
This practice enhances reusability and ensures standardized API responses throughout the application.



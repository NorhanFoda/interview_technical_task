# Laravel E-commerce Task

## Description
This is a Laravel application for managing orders, carts, products, and users.  
It demonstrates a simple, maintainable structure using controllers, services, repositories, events, listeners, and jobs.

## Project Structure
The project follows the default Laravel structure, with a few extra folders:

app/
├── Http/
│ ├── Controllers/
├── Models/
├── Services/
├── Repositories/
├── Events/
├── Listeners/
└── Jobs/


- **Controllers** handle incoming requests and return responses  
- **Services** handle business logic  
- **Repositories** handle database queries  
- **Events & Listeners** handle asynchronous operations  
- **Jobs** handle time-consuming tasks like generating invoices  

This keeps the code organized, easy to navigate, and allows adding new features without modifying existing logic.

## Installation / Setup
1. Clone the repository:  
   ```bash
   git clone https://github.com/NorhanFoda/interview_technical_task.git

2. Install dependencies:
    ```bash
    composer install
    ```
3. Setup the database:
    ```bash
    cp .env.example .env
    php artisan migrate --seed
    ```
4. Serve the application
    ```bash
    php artisan serve
    ```
5. Visit http://localhost:8000 in your browser to see the application.

Usage

Manage users, products, carts, and orders

Orders are processed asynchronously using jobs and events

Email notifications and invoice generation are handled by jobs

Business logic is kept in services; controllers are thin and readable

Planning Notes (Optional)
I included a few snapshots of my handwritten notes to show my initial thinking and structure. These are optional and not required for reviewing the task.
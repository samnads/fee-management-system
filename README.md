## Installation & Setup
  
Please follow these steps to setup project on localhost  
- git clone https://github.com/samnads/fee-management-system.git
- composer install
- php artisan migrate
- php artisan db:seed
- php artisan serve

<span style="color:red">Please note that **.env** file is also included</span>

Admin Login<br>
Username - **admin@example.com**<br>
Password - **12345**

## Features Used

  
- Migration for creating table schema
- Factory for dummy students data
- Databse seeder for courses data
- relationships to manage related database tables
- Auth for admin login
- Resource controller for quick api creation
- Built in pagination for pagination
- Used boostrap for frontend
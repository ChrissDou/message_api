# Task 2: Message Board API (CakePHP 5.x)

This is a simple message board API built with CakePHP.  
Users can submit and view messages. All data is stored in a MySQL database and returned as JSON responses.

---

## 📚 Features

- RESTful API with CakePHP 5.x
- JSON responses in unified format: `{ success: true/false, data: ... }`
- Uses classes to encapsulate data and logic (`MessagesController`, `MessagesTable`, `Message Entity`)
- Supports field validation (e.g. message required, username max 20 chars, message max 200 chars)
- Supports pagination via `?page=1&limit=5`
- Designed for API use (no HTML templates required)
- Data stored in MySQL (can also adapt to JSON file, array, or SQLite)

---

## 📦 Technologies Used

- Language: PHP
- Framework: CakePHP 5.x
- Database: MySQL
- Dev Tools: Composer, Postman

---

## ⚙️ Installation & Setup

1. Make sure you have [Composer](https://getcomposer.org/) installed.
2. Clone or extract this project to your web root.
3. Run:
   ```bash
   composer install
   bin/cake server -p 8765
4. Access the API at: http://localhost:8765/messages

🗃️ Database Setup
Import this table using phpMyAdmin or run the SQL below:
```sql
CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(20) NOT NULL,
  message TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```
Then configure config/app_local.php for your database settings:
```php

'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'your_username',
        'password' => 'your_password',
        'database' => 'your_database_name',
        'driver' => 'Cake\Database\Driver\Mysql',
        ...
    ]
]
```
📚 API Endpoints
```bash
Method        	Endpoint	                Description
GET	            /books	                    Get all messages
POST	        /books/add                	Add a new message
```
✅ Validation Rules
username:
Required
Max length: 20 characters

message:
Required
Max length: 200 characters

📥 Postman Collection
A Postman collection file is included:
📁 Messages API Collection.postman_collection

🙋 Author
Developed by: Boxuan Chen (陈博轩)

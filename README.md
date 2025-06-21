# Laravel 10 Order Processing API

This is a simple Laravel 10 application demonstrating how to:

- Create orders inside a database transaction
- Dispatch background jobs for order processing
- Ensure integrity using Laravel’s queue system

---

## 🧰 Tech Stack

- PHP 8.3
- Laravel 10.x
- MySQL (or compatible DB)
- Queue driver: Database
- Composer

---

## 🚀 Getting Started

### 1. Clone the Project

```bash
git clone https://github.com/ajaykumar-bot/task_order.git
cd task_order
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Create `.env` File

```bash
cp .env.example .env
```

Update `.env` with your DB and queue config:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

QUEUE_CONNECTION=database
```

### 4. Generate App Key

```bash
php artisan key:generate
```

---

## 🧱 Database Setup

```bash
php artisan migrate
php artisan queue:table
php artisan migrate
```

---

## 🧩 API Routes

> All routes are defined in `routes/api.php`.

### 📌 `POST /api/create-order`

Create a new order.

#### 🧾 Request Body

```json
{
  "user_id": 1,
  "amount": 500
}
```

#### ✅ Response

```json
{
  "message": "Order created successfully"
}
```

---

## ⚙️ Queue Setup

### 1. Start the Worker

```bash
php artisan queue:work
```

> Keep this running to process background jobs.

---

## 🧠 How It Works

- The controller wraps order creation in a DB transaction.
- If successful, a background job is dispatched to process the order.
- The job will update the order status from `pending` to `processed`.

---

## 🧪 Testing the API

You can test using Postman, Thunder Client, or cURL:

```bash
curl -X POST http://localhost:8000/api/create-order   -H "Content-Type: application/json"   -d '{"user_id": 1, "amount": 500}'
```

---

## 📂 Project Structure

```
app/
├── Http/
│   └── Controllers/
│       └── OrderController.php
├── Jobs/
│   └── ProcessOrder.php
├── Models/
│   └── Order.php
routes/
└── api.php
```

---

## 📜 License

MIT License
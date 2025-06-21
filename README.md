# Laravel 10 Order Processing API

This is a simple Laravel 10 application demonstrating how to:

- Create orders inside a database transaction
- Dispatch background jobs for order processing
- Ensure integrity using Laravel’s queue system

## 🧰 Tech Stack

- PHP 8.3
- Laravel 10.x
- MySQL (or any database)
- Queue driver: Database
- Composer

---

## 🚀 Getting Started

### 1. Clone the Project

```bash

git clone https://github.com/ajaykumar-bot/task_order.git
cd task_order



## install Dependecies
composer install

cp .env.example .env

## Update .env with your database settings:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
QUEUE_CONNECTION=database

## generate key
php artisan key:generate

## run migration
php artisan migrate

## queue setup

php artisan queue:table
php artisan migrate


## start the worker
php artisan queue:work

## on a different terminal run 
php artisan serve

```


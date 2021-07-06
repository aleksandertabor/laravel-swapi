🌌🔫 Laravel SWAPI
======================
> [Laravel SWAPI](https://swapi.alexprojects.pl/) - The Star Wars API (swapi.dev) example.

## 🖥️ Demo

Live demo (registration required): [swapi.alexprojects.pl](https://swapi.alexprojects.pl/)

![swapi](https://aleksandertabor.pl/wp-content/uploads/2021/07/laravel-swapi.gif)

# 🚩 Table of Contents

1. [Requirements](#-requirements)
2. [Installation](#-installation)
3. [Testing](#-testing)
4. [Data](#-data)
5. [Built with](#-built-with)
6. [To-do](#-to-do)

## 🔌 Requirements

- PHP version: >= 8
- Composer
- Node.js

## 🧾 Installation

1. `git clone https://github.com/aleksandertabor/laravel-swapi YOURPROJECTNAME`
2. `cd YOURPROJECTNAME`
3. Install dependencies:

    `composer install`

    `npm install`

4. `cp .env.example .env`
5. `php artisan key:generate`
6. Set your `.env` with credentials to your database server (`DB_*` settings) and your domain config (`APP_URL`).
8. `php artisan migrate`
9. Fetch data from SWAPI with Artisan command `php artisan swapi:fetch-characters 50`
10. Build frontend with `npm run production` for production.
11. Run your server `php artisan serve`.

Using Docker?

 Use `docker-compose.yml` with Laravel Sail - [installation](https://laravel.com/docs/8.x/sail#installing-sail-into-existing-applications)

## 🧪 Testing

`vendor/bin/phpunit tests`

## 🗂️ Data

The application uses data from [Swapi.dev - The Star Wars API](https://swapi.dev).

Artisan command for Star Wars characters with their movies titles: `php artisan swapi:fetch-characters {amount=50}`.


## 🧰 Built with

- Laravel 8
- Laravel Breeze as Starter kit (authentication features and frontend scaffolding - Inertia, Vue, Tailwind)
- Inertia.js 0.9+
- Vue.js v3
- Tailwind CSS 2+


## 📋 To-do

- More tests 🙂
- More options for Artisan command
- Split content of Vue pages for components
- Robust architecture (data management, validation)
- Handling more endpoints
- Fancy design
- ...

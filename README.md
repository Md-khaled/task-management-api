# User Management System

This Laravel application is a Person Management System that allows admin to create users.

## Technologies use

php "^8.2"
laravel "^11.0"

## Features

- Authentication system

## Installation

1. **Clone the repository:** `git clone <https://github.com/Md-khaled/task-management-api.git>`
2. **Navigate to the project directory:** `cd task-management-api`
3. **Install Composer dependencies:** `composer install`
4. **Copy the `.env.example` file to `.env` and configure your environment variables like MySql:** `cp .env.example .env`
5. **Generate a new application key:** `php artisan key:generate`
6. **Run database migrations to create the necessary tables:** `php artisan migrate:fresh`
7. `php artisan passport:client --personal`
8. **Serve the application:** `php artisan serve`

The application will be available at `http://localhost:8000`.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License

This project is licensed under the [Khaled Mahmud](https://github.com/Md-khaled).

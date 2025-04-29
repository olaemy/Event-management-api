# Event Management API

A RESTful API for managing events, built with Laravel.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

## Features

-   Create, read, update, and delete events.
-   User authentication and authorization.
-   Integration with [Pusher](https://pusher.com) for real-time updates.

## Installation

1. **Clone the repository**:

    ```bash
    git clone https://github.com/olaemy/Event-management-api.git
    cd Event-management-api
    ```

2. **Install PHP dependencies**:

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies**:

    ```bash
    npm install
    ```

4. **Configure Environment**:

    - Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update `.env` with your database credentials, Pusher keys, etc.

5. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

6. **Run Migrations and Seeders**:

    ```bash
    php artisan migrate:fresh --seed
    ```

7. **Start the Server**:
    ```bash
    php artisan serve
    ```

## Usage

-   **API Endpoints**: See `routes/api.php` or Swagger documentation at `http://localhost:8000/api/documentation`.
-   **Frontend**: Build assets with `npm run dev`.

## Contributing

Pull requests are welcome! For major changes, open an issue first.

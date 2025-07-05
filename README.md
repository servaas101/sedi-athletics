# Sedi Athletics Sports

This is a multi-tenant SaaS athletics and sports events management system built with Laravel 12 and MySQL, with Bootstrap 5 for the UI.

## Local Setup

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-repo/sedi-athletics-app.git
    cd sedi-athletics-app
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Create and configure your `.env` file:**
    ```bash
    cp .env.example .env
    ```
    Edit the `.env` file and update the database credentials:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sedi_athletics
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Create the database:**
    Ensure your MySQL server is running (e.g., via XAMPP). Then, create the database:
    ```bash
    mysql -u root -e "CREATE DATABASE IF NOT EXISTS sedi_athletics;"
    ```

6.  **Run migrations and seed the database:**
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Start the Laravel development server:**
    ```bash
    php artisan serve
    ```

    You can access the application at `http://127.0.0.1:8000` (or the port displayed in your terminal).

## Deployment to 20i Shared Linux Hosting

1.  **Upload your code:** Transfer all files and folders (except `node_modules` if it exists, and `.git` if you're not deploying via Git) to your hosting account's `public_html` directory (or a subdirectory if you prefer).

2.  **Configure `.env`:** Ensure your `.env` file on the server has the correct `APP_KEY` and database credentials for your hosting environment.

3.  **Run migrations and seeders:** Access your server via SSH or use a web-based terminal provided by 20i (if available) and run:
    ```bash
    php artisan migrate --force
    php artisan db:seed --force
    ```

4.  **Optimize Laravel:**
    ```bash
    php artisan optimize
    ```

5.  **Set directory permissions:** Ensure the `storage` and `bootstrap/cache` directories are writable by the web server.

6.  **Point webroot:** Configure your domain's webroot to point to the `public/` directory of your Laravel installation.

7.  **Enable HTTPS:** Ensure HTTPS is enabled for your domain.
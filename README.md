# Milk Tea Store Management - Ownego Test

A simple site built with Laravel to manage and view milk tea store menus based on the Ownego PHP Dev Test requirements.

## Features
* **AJAX Filtering**: Topping filters update the menu without page reloads.
* **AND Logic Filter**: Only shows products containing ALL selected toppings.
* **Dynamic Sorting**: Sort by Price and Name (Asc/Desc).
* **Data Handling**: Consumes data from JSON files in `storage/app/json/`.

## Installation
1.  **Clone the repository**
2.  **Install dependencies**
    ```bash
    composer update
    ```

3.  **Setup Environment**
    Create your environment file and generate the application key:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    > **Important:** Open your `.env` file and ensure the session driver is set to `file` to run the application without a database connection:
    >
    > `SESSION_DRIVER=file`

4.  **Run the Application**
    Start the local development server:
    ```bash
    php artisan serve
    ```
---

## Round 2: SQL Challenge

The SQL solutions for the Department and Employee queries (Round 2) are located in the root directory.

* **File:** [`php_round2.sql`](./php_round2.sql)
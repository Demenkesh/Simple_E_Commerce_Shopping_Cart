# Simple E-Commerce Shopping Cart

A minimal e-commerce application built with Laravel 11, Livewire, and Tailwind CSS. The system allows authenticated users to browse products, add items to a personalized cart, update quantities, and remove items. Cart data is persisted in the database and associated with the authenticated user.

This project was completed as a practical assessment task, demonstrating Laravel best practices, real-time updates with Livewire, queued jobs for notifications, and scheduled commands for reporting.

## Features

- **User Authentication**: Built-in Laravel Breeze (Livewire stack) for registration, login, and password management.
- **Product Browsing**: Display of products with name, price, stock status, and "Add to Cart" functionality.
- **Persistent Shopping Cart**:
  - Cart items stored in the database (`cart_items` table) linked to the authenticated user's `user_id`.
  - Real-time cart badge in the header showing total item quantity.
  - Dedicated cart page with quantity updates (+/- buttons), item removal, and subtotals.
- **Responsive UI**: Modern, mobile-friendly design using Tailwind CSS with smooth animations and alerts.
- **Low Stock Notification**:
  - When remaining stock (after cart addition) falls below or equal to 335 units, a queued job (`LowStockNotificationJob`) dispatches an email alert to `admin@example.com`.
- **Daily Sales Report**:
  - Scheduled Artisan command (`report:daily-sales`) runs every evening (20:00) via Laravel scheduler.
  - Aggregates products added to carts that day (as a proxy for sales in this simple system), calculates quantities and potential revenue, and emails a formatted report to `admin@example.com`.
- **Flash Alerts**: Global success/error notifications with Alpine.js animations for user feedback.
- **Real-Time Updates**: Cart badge and views refresh instantly via Livewire events (`cart-updated`).

## Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Livewire (Volt components for auth, standard Livewire for cart/product logic)
- **Styling**: Tailwind CSS
- **Database**: MYSQL
- **Queue**: Database driver (configurable)
- **Email**: Mailhog or Laravel Log driver recommended for local testing

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM (for asset compilation)
- MYSQL 
## Installation

### 1. Clone the repository:
   ```bash
   git clone https://github.com/Demenkesh/Simple_E_Commerce_Shopping_Cart.git
   cd simple-ecommerce-cart
```
### 2. Install dependencies:
```bash
composer update
npm install
npm run build
```

### 3. Set Up Environment Configuration
Copy the .env.example file and update the necessary environment variables the database and email :
```bash
cp .env.example .env
```

### 4. Then generate the application key:
```bash
php artisan key:generate
```
Update your .env file with your database and other environment-specific configurations.

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed the Database
seed sample data
```bash
php artisan db:seed
```
### 7. Start the development server:
```bash
php artisan serve
```
Visit http://localhost:8000 and register/login to begin.
Replace {{your-app-url}} with your actual domain or local environment URL (e.g., http://localhost:8000).

### 8. Start workers
```bash
php artisan cache:clear
php artisan route:clear
php artisan config:clear
php artisan view:clear
php artisan clear-compiled
php artisan optimize:clear
php artisan queue:restart
php artisan queue:work
```
### 9. Start Manual report
```bash
php artisan schedule:work
```

## Usage

#### Register/Login: Use the authentication pages to create an account.

#### Browse Products: View the product list (typically at / or root).

#### Add to Cart: Click "Add to Cart" on available products.

#### View Cart: Click the cart icon in the header (links to /cart).

#### Update/Remove: Adjust quantities or remove items on the cart page.

#### Admin Emails: set up the admin mail in the env file (MAIL_FROM_ADDRESS)

#### Low stock alerts sent via queue (run php artisan queue:work for processing).

#### Daily report sent at 20:00 (configure server cron or test with php artisan schedule:work).


## License

This README provides clear, professional documentation suitable for submission. It highlights adherence to the task requirements while explaining setup and functionality concisely. Replace placeholder details (e.g., [repository URL](https://github.com/Demenkesh/Simple_E_Commerce_Shopping_Cart.git)) as needed for your actual submission.

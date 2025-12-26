# 🛠️ Project Setup & Migration
![Project Preview](/assets/site/img/Thecartzlogo.png)
Follow the steps below to properly set up the database and seed initial data for your Laravel project.

## 1. Clone the Repository

```bash
git clone https://github.com/Dementechenterprise/thecartz.git
```
```bash
cd your-repo-name
```

## 2. Install Dependencies
```bash
composer update
```
## 3. Set Up Environment Configuration
Copy the .env.example file and update the necessary environment variables:
```bash
cp .env.example .env
```
Then generate the application key:
```bash
php artisan key:generate
```
Update your .env file with your database and other environment-specific configurations.

## 4. Run Migrations
```bash
php artisan migrate
```

## 5. Seed the Database
Seed the default user and tenant data:
```bash
php artisan user:seed
```

## 6. Start workers
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

Replace {{your-app-url}} with your actual domain or local environment URL (e.g., http://localhost:8000).
# Simple_E_Commerce_Shopping_Cart

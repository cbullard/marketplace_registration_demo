## Registration Form

### Project Overview

This project uses Laravel 8, Vue 2, Axios, and Tailwind.

The Laravel View named 'seller_registration.blade' is where Vue will be loaded.

I had at first hard-coded the Category answers while building out step 1, but I moved all dropdown answers into a table. They could also be stored in an array, but just like hard coding them in the template,

All the questions in the dropdowns are stored in the database so that it's easily updated by people other than developers if a company side administation form was created. To get everything up and running, I added a seeder that will run automatically when the 'seller_application_fields' table is created which will have initial options in the dropdowns.

### Vue Source File Locations

`resources/js/components/seller-registration/` & `resources/js/store/`

### Overview of Database Schema

The data gathered from the registration form will be used to accept or decline new sellers. Once accepted, sellers would be moved into the **_users_** table. This functionality is currently not implimented in this code.

```sql
CREATE TABLE `sellers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `online_stores` text COLLATE utf8mb4_unicode_ci,
  `category` smallint unsigned NOT NULL,
  `perspective` smallint unsigned NOT NULL,
  `experience` smallint unsigned NOT NULL,
  `understanding` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sellers_portfolio_unique` (`portfolio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `seller_application_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` smallint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

### Setup Instructions

-   Clone repo to your local device.
-   Change into the `creative-market` directory
-   Run `composer install`
-   Run `sail artisan key:generate`
-   Run `sail up -d`
-   Create a database named `laravel` (details below)
-   Copy `.env.example` to `.env`
-   Run `sail artisan migrate`
-   Run `npm install`
-   Run `npm run dev`
-   Visit http://localhost

Creating Database: Using your favorite DB editor, connect to the database with these details. Then create db named `laravel`

-   host 127.0.0.1
-   user: root
-   password is empty

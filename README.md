# Laboratory Activity 3: Online Bookstore Management System

**Student:** Rinante Buntod  
**Due Date:** Feb 9, 2026

## Scenario – PageTurner Online Bookstore
PageTurner Inc. is a growing online bookstore company that aims to modernize its operations by building a comprehensive web-based management system called the **PageTurner Online Bookstore Management System**.

## Target Users and Capabilities

### Administrators
- **Manage Books (CRUD)**: Full control over the book inventory, including titles, authors, ISBNs, prices, and stock quantities.
- **Manage Categories (CRUD)**: Organize books into genres/categories with descriptions and slugs.
- **View Customer Orders**: Monitor all orders placed by customers and update their status (Pending, Processing, Completed, Cancelled).

### Registered Customers
- **Browse Books & View Details**: Explore the catalog and read detailed information about each book.
- **Place Orders**: Purchase books with real-time stock and price calculations.
- **Write Reviews**: Provide star ratings and comments for books they have successfully purchased and received.

### General Visitors
- **Browse Catalog**: View the available collection of books.
- **View Details**: Read book information and existing reviews.
- **Restrictions**: Cannot place orders or write reviews without an account.

## Technical Implementation

- **Framework**: Laravel 11.x
- **Authentication**: Laravel Breeze (Tailwind CSS)
- **Database**: SQLite (default) / MySQL
- **Core Features**:
  - Eloquent Relationships (User ↔ Orders ↔ OrderItems ↔ Books, Books ↔ Reviews, Books ↔ Category)
  - Role-Based Access Control (RBAC) via middleware
  - Custom Resource Controllers for Books, Categories, and Orders
  - Dynamic Blade Components and Layouts
  - Seeders and Factories for realistic sample data

## Getting Started

1. **Clone the repository**:
   ```bash
   git clone [repository-url]
   cd pageturner-bookstore
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup**:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Run the application**:
   ```bash
   php artisan serve
   ```

## Admin Credentials
- **Email**: `admin@example.com`
- **Password**: `password` (standard seeder password)

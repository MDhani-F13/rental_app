# RentalApp

A full-stack equipment rental management application built with Laravel and Livewire.

RentalApp allows customers to browse available equipment, choose rental dates, submit rental requests, and track their rental history. Administrators can manage equipment, customers, rental requests, and rental status through a dedicated dashboard.

The application uses **date-based inventory availability**, meaning equipment stock represents the total physical units owned while availability is calculated dynamically from overlapping rental periods.

---

## Features

### Customer

* Browse equipment without logging in
* Search and filter equipment
* Check equipment availability based on selected rental dates
* Submit rental requests
* View rental history
* Cancel pending rental requests
* Update profile information
* Change password
* Light, dark, and system appearance modes
* Responsive mobile navigation

### Administrator

* Dashboard with rental and inventory statistics
* Equipment management
* Customer management
* Rental request approval and rejection
* Mark active or late rentals as returned
* Search and filter rentals
* Search and filter customers
* Automatic late-rental detection
* Light and dark mode support
* Responsive administration interface

---

## Rental Lifecycle

A rental can move through the following states:

```text
Pending
   │
   ├── Cancelled
   │
   └── Rented
          │
          ├── Returned
          │
          └── Late
                 │
                 └── Returned
```

### Pending

A customer has submitted a rental request, but it has not yet been approved.

Pending requests **do not reserve equipment**.

### Rented

The administrator has approved the request.

The requested quantity is considered unavailable during the approved rental period.

### Late

A rental becomes late when its return date has passed and the equipment has not been returned.

Late equipment remains unavailable until the administrator marks the rental as returned.

### Returned

The equipment has been returned and no longer affects availability.

### Cancelled

The request was cancelled by the customer or rejected by the administrator.

Cancelled rentals do not affect availability.

---

## Date-Based Inventory System

Instead of reducing the `stock` column whenever equipment is rented, RentalApp treats:

```text
equipment.stock
```

as the **total number of physical units owned**.

For example:

```text
Camera stock = 5
```

means the business physically owns five cameras.

Availability is calculated dynamically for the requested rental period.

For a requested date range:

```text
[requested_start, requested_end)
```

an existing rental overlaps when:

```text
existing.rent_date < requested.return_date
AND
existing.return_date > requested.rent_date
```

The application then calculates:

```text
Available quantity
=
Total physical stock
-
Quantity reserved by overlapping approved rentals
```

For example:

```text
Total camera stock:             5

Rental A:
September 1 → September 5
Quantity: 2

Rental B request:
September 3 → September 7

Available quantity for Rental B:
5 - 2 = 3
```

A rental ending on September 5 does not conflict with another rental beginning on September 5 because rental periods use a half-open interval:

```text
[start_date, return_date)
```

This allows returned equipment to immediately become available for another rental beginning on the return date.

### Late Rentals

Late rentals are treated differently.

Because the equipment has not actually been returned, its original return date can no longer be trusted as the end of its unavailable period.

Therefore, a late rental continues to reserve its quantity until the rental is explicitly marked as returned.

### Approval Safety

Availability is checked again when an administrator approves a Pending request.

This prevents two Pending requests from both being approved when their combined quantities would exceed available stock.

---

## Technology Stack

### Backend

* PHP
* Laravel
* Laravel Livewire
* Laravel authentication
* PostgreSQL

### Frontend

* Blade
* Livewire
* Flux UI
* Tailwind CSS
* Alpine.js
* Vite

---

## Project Structure

Important application areas include:

```text
app/
├── Http/
│   └── Controllers/
│       └── Customer/
│           └── Auth/
├── Livewire/
│   ├── Admin/
│   │   ├── Dashboard
│   │   ├── Equipment
│   │   ├── Rentals
│   │   └── Customers
│   │
│   └── Customer/
│       ├── Store
│       ├── Rentals
│       └── Profile
│
└── Models/
    ├── User
    ├── Customer
    ├── Equipment
    └── Rental
```

The application uses separate authentication guards for administrators and customers.

```text
web guard      → Administrator
customer guard → Customer
```

---

## Database Relationships

```text
Customer
   │
   └── hasMany
          │
        Rental
          │
          └── belongsTo
                 │
             Equipment
```

Each rental belongs to exactly one customer and one equipment item.

Foreign-key deletion is restricted instead of cascading so historical rental records cannot accidentally disappear when referenced customers or equipment are deleted.

---

## Installation

Clone the repository:

```bash
git clone <repository-url>
cd rental-app
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your PostgreSQL database in `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=rental_app
DB_USERNAME=postgres
DB_PASSWORD=
```

Run migrations and seed the demo database:

```bash
php artisan migrate:fresh --seed
```

> `migrate:fresh` deletes all existing database tables and data. Use it only when resetting a development or demo database.

Create the storage link if equipment images use Laravel storage:

```bash
php artisan storage:link
```

Start Laravel:

```bash
php artisan serve
```

Start Vite:

```bash
npm run dev
```

---

## Demo Accounts

The demo seeder creates predictable accounts for testing.

### Administrator

```text
Email: admin@rental.test
Password: password
```

### Customer

```text
Email: customer@rental.test
Password: password
```

These credentials are intended for local development and demonstration only.

The demo customer contains rental examples covering:

* Pending
* Rented
* Late
* Returned
* Cancelled

---

## Demo Data

The database seeder creates:

* Demo administrator
* Demo customer
* Additional customers
* Multiple equipment categories
* Realistic equipment names and prices
* Historical returned rentals
* Cancelled rentals
* Pending requests
* Controlled active and late rentals

Active rentals are intentionally generated conservatively so seeded data does not create impossible stock availability.

---

## Automatic Late Rental Detection

RentalApp includes an Artisan command that changes overdue active rentals from:

```text
Rented → Late
```

when:

```text
return_date < today
```

A rental whose return date is today remains `Rented`.

The command is scheduled to run automatically each day.

---

## Screenshots

### Equipment Store

![Equipment Store](docs/screenshots/customer-store.png)

### Admin Dashboard

![Admin Dashboard](docs/screenshots/admin-dashboard.png)

### Rental Management

![Rental Management](docs/screenshots/admin-rentals.png)

## Demo

The following demonstrates the complete rental request and approval workflow.

![Rental workflow](docs/screenshots/rental-store-flow.gif)

A typical demonstration can follow this sequence:

```text
1. Customer opens the public equipment store
2. Customer selects equipment
3. Customer chooses rental dates and quantity
4. Customer submits a rental request
5. Rental appears as Pending
6. Administrator reviews the request
7. Administrator approves the request
8. Rental becomes Rented
9. Equipment availability changes for overlapping dates
10. Rental becomes Late if its return date passes
11. Administrator marks the equipment as Returned
12. Equipment becomes available again
```

---

## Development Notes

RentalApp was designed as more than a basic CRUD inventory application.

The primary business rule is that rental inventory depends on **time**, not simply whether an item is currently marked as rented.

This allows the same physical equipment to be booked for multiple non-overlapping future rental periods while preventing overbooking during overlapping periods.

---

## License

This project is intended for educational and portfolio purposes.

# Multi-Tenant Project Management System (Laravel + Spatie)

## Overview

This project is a **multi-tenant SaaS application** built using **Laravel** and **Spatie Multitenancy**.
Each tenant (company) has its own isolated database where users, roles, permissions, and projects are stored.

The system supports **centralized admin management** and **tenant-level project management with role-based access control**.

---

## Installation & Setup

Clone the repository:
```bash
git clone https://github.com/MALKA-ANJUM/Multi_Tenancy_Project
cd Multi_Tenancy_Project
```

Install dependencies:
```bash
composer install
```

Copy environment file:
```bash
cp .env.example .env
```
Generate application key:
```bash
php artisan key:generate
```
Configure your central database in .env:

DB_CONNECTION=mysql
DB_DATABASE=main_database
DB_USERNAME=root
DB_PASSWORD=

Run migrations:
```bash
php artisan migrate
```
Run seeders:
```bash
php artisan db:seed
```
Start the development server:
```bash
php artisan serve
```
## Features

### 1. Multi-Tenancy

* Implemented using **Spatie Multitenancy**
* Each tenant has:

  * Unique domain
  * Separate database
* Automatic database switching based on tenant domain.

### 2. Authentication System

* **Admin authentication** from central database.
* **Tenant user authentication** from tenant database.

### 3. Role & Permission Management

Implemented using **Spatie Permission**.

Features:

* Create roles
* Create permissions
* Assign permissions to roles
* Assign roles to users

Role management is tenant-specific.

### 4. User Management

Tenant admins can:

* Create users
* Update users
* Delete users
* Assign roles to users

### 5. Project Management Module

Each tenant can manage projects independently.

Capabilities:

* Create projects
* Update projects
* Delete projects
* Assign multiple users to projects
* Update project status directly from project list

Project statuses include:

* **Pending**
* **In Progress**
* **Completed**

### 6. User-Project Assignment

Projects support **many-to-many relationships** with users.

Example:
Project A → John, Sarah
Project B → Mike, Alex

### 7. Project Status Management

Project status can be changed directly from the project listing page using a dropdown.

---

## Tech Stack

* **Laravel**
* **MySQL**
* **Spatie Multitenancy**
* **Spatie Laravel Permission**
* **Blade Templates**
* **Bootstrap UI**

---

## Database Architecture

### Central Database

Stores:

* Admin users
* Tenants

### Tenant Database

Each tenant has its own database containing:

* users
* roles
* permissions
* model_has_roles
* role_has_permissions
* projects
* project_user (pivot table)

---

## Project Structure

```
app/
 ├ Controllers
 │   ├ AuthController
 │   ├ AdminController
 │   ├ ProjectController
 │   └ RoleAndPermissionController
 │
 ├ Models
 │   ├ Tenant
 │   ├ User
 │   ├ AdminUser
 │   ├ Project
 │   ├ Role
 │   └ Permission
```

---

## Key Relationships

User ↔ Project
(Many-to-Many)

```
users
projects
project_user
```

---

## Main Functional Modules

| Module             | Description                          |
| ------------------ | ------------------------------------ |
| Tenant Management  | Register and manage tenant companies |
| Authentication     | Admin and tenant user login          |
| Role & Permission  | Role-based access control            |
| User Management    | Tenant user CRUD                     |
| Project Management | Project CRUD with status tracking    |

---

## Example Workflow

1. Admin registers a new company.
2. A tenant database is created.
3. Tenant users log in through their domain.
4. Tenant admin creates users and roles.
5. Projects are created and assigned to users.
6. Project status is tracked and updated.

---

## Learning Outcomes

This project demonstrates:

* Multi-tenant SaaS architecture
* Role-based authorization
* Database isolation per tenant
* Many-to-many relationships
* Modular Laravel architecture

---

## Author

Developed by Malka Anjum
Full Stack Laravel & React Developer

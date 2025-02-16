# Contact Management System

A Laravel-based CRUD application to manage contacts with features like soft delete, bulk import via XML, and an enhanced UI.

## Features

- **CRUD Operations** – Add, Edit, Delete, and View contacts
- **Soft Delete & Restore** – Trashed contacts can be restored or permanently deleted
- **Bulk Import via XML** – Removes spaces from phone numbers and prevents duplicate entries
- **Enhanced UI** – Full-screen, responsive design using Bootstrap & FontAwesome
- **Validation** – Ensures uniqueness and proper formatting of contact names and phone numbers

## Installation Guide

### Step 1: Clone the Repository
- cd contact-manager

### Step 2: Install Dependencies
- composer install

### Step 3: Configure Environment
- cp .env.example .env
- php artisan key:generate

### Step 4: Run Migrations
- php artisan migrate

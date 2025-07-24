# 🧾 Customer Relationship Management System

## ✨ Overview

This is a full-featured CRM (Customer Relationship Management) web application built using Laravel. It helps businesses manage customers, leads, tasks, and communications in one centralized dashboard.

## 🚀 Features

- Customer & Lead Management
- Task & Activity Tracking
- User Roles & Permissions
- Email Notifications
- Responsive Dashboard UI

## 🛠️ Tech Stack

- **Backend**: Laravel 10
- **Frontend**: Blade, Bootstrap / Tailwind CSS
- **Database**: MySQL
- **Other Tools**: Composer, Laravel Mix, Git

## 📦 Installation

# Clone the repository
git clone https://github.com/your-username/crm-web-app.git

# Go into the project folder
cd crm-web-app

# Install PHP dependencies
composer install

# Copy the .env example file
cp .env.example .env

# Generate the app key
php artisan key:generate

# Set up your database in the .env file
# Then run migrations
php artisan migrate

# Serve the application
php artisan serve

# 🧾 Customer Relationship Management System

## ✨ Overview

This is a full-featured CRM (Customer Relationship Management) web application built using Laravel. It helps businesses manage customers, leads, and communications in one centralized dashboard.

## 🚀 Features

- Customer & Lead Management
- User Roles & Permissions
- Email Notifications
- Responsive Dashboard UI

## 🛠️ Tech Stack

- **Backend**: Laravel 10
- **Frontend**: Bootstrap
- **Database**: MySQL
- **Other Tools**: Composer, Git

## 📦 Installation

# Clone the repository
git clone https://github.com/your-username/crm.git

# Go into the project folder
cd crm

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

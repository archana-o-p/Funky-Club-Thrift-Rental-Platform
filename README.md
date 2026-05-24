# Funky Club – Online Thrift & Rental Clothing Platform

## Overview
Funky Club is a web-based **Thrift and Rental Clothing Management Platform** that enables users to **buy thrift clothing**, **rent fashion items**, and allows sellers to manage listings through a dedicated dashboard. The system provides a centralized platform where users can buy thrift clothing, rent clothes, and sellers can upload and manage their products.
The platform promotes **sustainable fashion practices** by extending clothing life cycles and reducing textile waste through resale and rental workflows.

## Features

### Guest Module
- Home page access
- User Registration
- Seller Registration
- Login page access

### User Module
- Browse thrift clothing products
- Rent clothing items
- Add products to cart
- Place orders
- View order history
- Submit complaints
- Give ratings and reviews
- Profile management

### Seller Module
- Add thrift products
- Upload rental clothing items
- Manage product stock
- View orders and bookings
- Complaint handling
- Profile management

### Admin Module
- Manage categories and subcategories
- Manage sizes, colors, and materials
- Seller verification
- User management
- Complaint management
- Location management
- Reports and monitoring


## Technologies Used

### Frontend
- HTML5
- CSS3
- Bootstrap
- JavaScript
- jQuery
- AJAX

### Backend
- PHP

### Database
- MySQL / MariaDB

### Server Environment
- XAMPP / WAMP Server


## Database Tables

The project contains the following major tables:

- `tbl_admin`
- `tbl_user`
- `tbl_seller`
- `tbl_category`
- `tbl_subcategory`
- `tbl_product`
- `tbl_rentproducts`
- `tbl_booking`
- `tbl_cart`
- `tbl_stock`
- `tbl_color`
- `tbl_size`
- `tbl_material`
- `tbl_complaint`
- `tbl_rating`
- `tbl_gallery`
- `tbl_rentproductbooking`
- `tbl_district`
- `tbl_place`
- `tbl_gender`



## Database design follows **3rd Normal Form (3NF)** to reduce redundancy and improve data consistency.


##  Project Structure

Project/
│
├── Admin/
├── Seller/
├── User/
├── Guest/
├── Assets/
├── SpryAssets/
├── database/
├── documentation


##  Installation

Clone repository:

git clone https://github.com/USERNAME/Funky-Club.git

Move project to:

xampp/htdocs/

Import database:

CREATE DATABASE funkyclub;

Import SQL file using phpMyAdmin.

Run:

http://localhost/Project/



##  Problem Statement

Fast fashion contributes significantly to textile waste and environmental impact.
Funky Club addresses this challenge by enabling:
- Reuse through thrift sales
- Clothing rental systems
- Affordable fashion access
- Sustainable consumption practices

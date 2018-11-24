# Laravel-shop
Example: http://laravel-shop.grzojda.usermd.net
# Installation
1. Deploy like any laravel project
2. Change database name, username, password
3. For working payment system You have to:

    - change $paymentDetails in /app/Http/Controllers/CartsController.php::submit() 
    - change form action in Laravel-shop/resources/views/product/submit.blade.php 

# Features
1. First registered user is administrator
2. User don't have to confirm they email
3. Dotpay payment connected
4. Cart
5. Discount system
6. Products Category
7. Administrator can manage discounts, products and categories

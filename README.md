# Finances API

A Expense Tracker application that users can keep track of their transactions.

This repository is only for the API of the application. The client side is in the following repository: https://github.com/matews-sousa/expense-tracker-client

## Demo

You can view the project live at [[https://expense-tracker-api-production-8f04.up.railway.app](https://expense-tracker-server-production-bfda.up.railway.app)](https://expense-tracker-server-production-bfda.up.railway.app)

## Run Locally

1. Clone the project

    ```bash
    git clone https://github.com/matews-sousa/expense-tracker-server.git
    ```

2. Go to the project directory

    ```bash
    cd expense-tracker-server
    ```

3. Install dependecies

    ```bash
    composer install
    ```
    
4. Setup environment variables

    6.1. Run `mv .env.example .env`
    
    6.2. Add the values to the needed variables
        - Run `php artisan key:generate`

5. Migrate schemas

    ```bash
    php artisan migrate
    ```
6. Start server

    ```bash
    php artisan serve
    ```

From that you can use this API to implement your own Frontend or use the one that I've created in the following repository: https://github.com/matews-sousa/expense-tracker-client

## Instructions

You can make requests using Postman or Insomnia, the routes for Categories and Transactions are protected by Sanctum authentication, so you will need to register a user in the route `api/register` and get the token.

The protected routes need to have in the `Authorization` a type of *Bearer Token* with the value of the token of the online user. 

## Tech Stack

- PHP as programming language
- Laravel as backend framework
- Sanctum for user authentication
- Railway for deployment

## Features

- Sign Up
- Login with email and password
- CRUD functionalities for Categories
- CRUD functionalities for Transactions

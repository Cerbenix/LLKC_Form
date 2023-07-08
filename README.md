# LLLKC-Form
## Description

LLKC test assignment - Form

Custom php OOP backend

React frontend with Tailwind CSS

Features included:

1. Registration and login forms with validation on frontend and backend
2. Authentication and authorization with generated JWT(JSON Web Token)
3. User table view implemented with [datatables.net](https://datatables.net/)

## Project Setup

#### Install

``` composer install ```

#### Setup .env file

``` cp .env.example .env ```

You will need to provide the database connection parameters and create a secret key for JWT generation.

#### Import database

For a generic tutorial of how to import a database follow the directions [here](https://www.digitalocean.com/community/tutorials/how-to-import-and-export-databases-in-mysql-or-mariadb).

#### Launch local server

``` php -S localhost:8000 -t public/ ```

This will run the built frontend from the public folder.

### Making frontend changes

#### Install

Navigate to the frontend folder.

``` cd .\frontend\ ```

``` npm install ```

#### Compile and Hot-Reload for Development

``` npm run dev ```

#### Type-Check, Compile and Minify for Production

```npm run build```

## Take a look

### Registration form
![image](https://github.com/Cerbenix/LLLKC-Form/assets/124684938/6f0b5d87-cda7-4b7d-9427-63eccdd14520)

### User table view
![image](https://github.com/Cerbenix/LLLKC-Form/assets/124684938/5ed34f94-f154-4ca9-a47f-582040eda9ff)


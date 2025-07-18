<p align="center">
  <img src="https://i.ibb.co/4pwyZ2G/insta-app-copycat.png" width="400" alt="Insta App Copycat">
  <br>
  <img src="https://img.shields.io/badge/Version-1.0-green" alt="Version">
  <img src="https://img.shields.io/badge/License-MIT-blue" alt="License">
  <img src="https://img.shields.io/badge/Laravel-9.32.0-red" alt="Laravel Version">
</p>

## About Insta App Copycat

Insta App Copycat is a RESTful API built with Laravel framework that mimics the features of Instagram. This API allows you to create, read, update, and delete resources such as users, posts, comments, likes, and followers. The API also includes features such as authentication, authorization, and pagination.

## Features

### User Management

-   User registration
-   User login

### Post Management

-   Post creation
-   Post retrieval
-   Post update
-   Post deletion
-   Post like
-   Post unlike
-   Post edit log

### Comment Management

-   Comment creation
-   Comment retrieval
-   Comment update
-   Comment deletion
-   Comment edit log

### Technologies Used

-   Authentication with Laravel Sanctum

## Routes

### User Routes

-   `POST /register` - Register a new user
-   `POST /login` - Login a user
-   `GET /me` - Retrieve the authenticated user
-   `PUT /me` - Update the authenticated user
-   `DELETE /me` - Delete the authenticated user

### Post Routes

-   `POST /posts` - Create a new post
-   `GET /posts` - Retrieve all posts
-   `GET /posts/{post}` - Retrieve a single post
-   `PUT /posts/{post}` - Update a post
-   `DELETE /posts/{post}` - Delete a post
-   `POST /posts/{post}/likes` - Like a post
-   `DELETE /posts/{post}/likes` - Unlike a post
-   `GET /posts/{post}/edit-log` - Retrieve the edit log of a post

### Comment Routes

-   `POST /comments` - Create a new comment
-   `GET /comments` - Retrieve all comments
-   `GET /comments/{comment}` - Retrieve a single comment
-   `PUT /comments/{comment}` - Update a comment
-   `DELETE /comments/{comment}` - Delete a comment
-   `GET /comments/{comment}/edit-log` - Retrieve the edit log of a comment

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `php artisan migrate`
4. Run `php artisan serve`

## Import Insomnia

The Insomnia file is located in the `import` folder. To import the file, open Insomnia and click on the `Import` button in the top left corner. Then, select the `import.json` file and click on the `Import` button.

## License

Insta App Copycat is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

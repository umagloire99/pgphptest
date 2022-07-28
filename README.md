<p align="center">
    <h1 align="center">Pictureworks Laravel Coding Test</h1>
    <br/>
</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Introduction

Pictureworks Laravel Coding Test: Migration of non-oo legacy application into the Laravel/Eloquent framework.

## Table of Contents

1. [Requirements](#requirements)
2. [Features](#features)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Testing](#testing)


## Requirements
Make sure your server meets the following requirements.

-   PostgreSQL server
-   Composer installed 1.9+
-   PHP Version 7.4.x+

## Features:

- [x] Show user detail
- [x] Update existing comments field of user with identifier ```id``` provided 
- [x] A command line executions to update comments of specific user such as ```php controller.php ID COMMENTS```
  where ```ID``` is user identifier and ```COMMENTS``` is some amount of comments, potentially with spaces.


## Installation

Install composer with the help of the instructions given [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
``` bash  
$ wget https://getcomposer.org/composer.phar
$ chmod +x composer.phar
$ mv composer.phar /usr/local/bin/composer
```

Fork and/or clone this project by running the following command
``` bash  
 git clone  https://github.com/umagloire99/pgphptest.git
```

Navigate into the project's directory
``` bash  
 cd pgphptest 
```

Copy .env.example for .env and modify according to your credentials
```bash
 cp .env.example .env
```

Run this command to install dependencies
```bash
 composer insatall --prefer-dist
```
This command will install all dependencies needed by the Pictureworks Laravel Coding Test to run successfully!

Generate application key
```bash
 php artisan key:generate
```

This command will help migrate the database and populate the database!
```bash
 php artisan migrate --seed
```

## Usage
Run the default laravel server
```bash
php artisan serve
```
### Show User detail
- Request: ```GET```
- Url ```http://localhost:8000/user/{id}``` where id is the unique user identifier 

### Update existing comments field of user
- Request ```POST```
- Url ```http://localhost:8000/user/update-comments```
- Parameters: ```id```(unique user identifier type integer), ```comments```(type string) and ```password```(type string)

By default, we have created 10 fake user data.

## Testing
Run this command to test the different endpoints
```bash
vendor/bin/phpunit tests/UserControllerTests.php  
```

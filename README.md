## Table of Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Database](#database)
- [API](#api)
- [Password Encoding](#passwordencoding)
- [Bonus](#bonus)

## Introduction

The goal of this test is to create a basic API to manage admin users and allow them to login 

## Requirements

+ PHP 7.2 or higher 
+ Use a PHP Framework (Example : Symfony, Laravel, ...)
+ PostgreSQL

## Database

A dump file of the database is available and located in the `db` folder of this repository 

>Tables
* **admin_user**
<br/>*Store the backoffice users*

* **admin_path**
<br/>*Store the different route paths managed by the ACL*

* **admin_role** 
<br/>*Store the different roles assigned to admin users*

* **admin_user_role** 
<br/>*Admin User Role association table<br/>Store the association between a role and an user*

* **admin_role_path**
<br/>*Admin Role Path association table<br/>Store the association between a role and a path*

>Data
* Admin user passwords
    <br/>*All users have the same hashed password in database which is 'pandacraft'* 
    
* PHP Method used to generate hashed stored passwords 
    ~~~ 
    password_hash('pandacraft', PASSWORD_BCRYPT, ['cost' => 10]);
    ~~~

## API

> You have to provide different endpoints

* **/admin/user**
<br/>*Allow admin user listing / filtering / modifications / ...*

* **/admin/me**
<br/>*Returns the logged user, if there is a logged user*

* **/auth/admin/login**
<br/>*Allow user login action by posting username & password*

## Bonus
* Choose a coding standard
* Choose an API standard
* Choose a standard for automated technical documentation generation
* Manage API Versioning
* Implement Tests
* Feel free to add / do whatever it seems wise to you
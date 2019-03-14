# Manual of the recruitment backend application

A Symfony 4 website skeleton has been used as the backend for the API and FOSRestBundle as the tool to create the REST API

The database given with the project is based on PostGreSQL and the application has been configured accordingly

## Installation

1. Clone the repository
2. Create a database
3. Load the dump provided in the db directory
4. Create a .env.local file and configure the access to the PostGreSQL database. Example : DATABASE_URL=pgsql://root@127.0.0.1:5432/pandacraft
5. Launch the server embedded in the Symfony framework or create a virtual host if using a web server

## AdminUser API

The AdminUser REST API is reachable with the /admin/user prefix

5 actions are available :

URL | Method | Description | Example
-|-|-|-
/admin/user | GET | Returns the list of all users | /admin/user
/admin/user/{id} | GET | Returns the user whose id is given in the URL | /admin/user/1
/admin/user | POST | Creates a new user from data submitted with the form AdminUserType | /admin/user
/admin/user/{id} | PUT | Updates an existing user whose id is given in the URL and the data submitted with the AdminUserType form | /admin/user/2
/admin/user/{id} | DELETE | Deltes am existing user whose id is given in the URL | /admin/user/3

### Test the API

The API is fully testable with a tool like Postman

### Test interface

A full interface is available from the URL /test to test the AdminUser REST API

The interface allows to list, create, update and delete users

## TODO

2 main points are left to do :
- the endpoint that returns the logged user if any
- the endopint that authenticated a user

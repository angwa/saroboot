# Saroboot - PHP MVC framework for API coding

This project is written with Model - View - Controller (MVC) architecture. Look at this article for more understanding of [MVC Architecture](https://www.javatpoint.com/php-mvc-architecture). The framework is made for writting super API endpoints. It implements JSON Web Token for user  Authentication. Please take a look at  [JWT](https://jwt.io/). 

## Postman Documentation
Please import the postman collection from the root folder with the name ```saroboot.postman_collection.json``` after successful installation

## Installation and usage

This framework requires PHP 7.4  or higher
.  
You can simply clone  `` saroboot`` like below on your bash

```bash
git clone https://github.com/angwa/saroboot.git
```
## NOTICE: 
The folder should be cloned to htdocs folder of your xamp or www folder of your wamp


### Next step. VERY Important

Run composer update on your bash
```bash
composer update
```

Create a new database and import the database file ```database.sql``` inside ```db``` folder on the root directory of ```saroboot```. The database only contain the  ```users``` table which we will use for demostration

The next step is to configure your environment. Simply open ```config.php``` on the root directory and edit the password and database to suit you. The file looks like this
```
<?php
namespace
{
    /**
     * Framework is written by Angwa, Ogbole Moses
     * The configuration variable to be used
     * Edit the file fields to fit your need
     * All fields are necesarry
     */
    class Config
    {
        public $env;
        public function __construct()
        {
            $this->env = array(
                'hostname' => 'localhost', //Your servername used for Database and JWT

                'username' => 'root',       //the server username

                'password' => 'mypassword',       // the server password

                'database' => 'saroboot',   //database name. can be your new database name
            );
        }
    }
}


```
### Routing

Routes to endpoints are written in ```route.php``` found in the root directory of your project. For example to create a route called ```login``` with post method, you can simply do something like this.

```
Route::add('/login', fn() =>LoginController::login(),'post');
```
With this route, you can visit the endpoint, lets say on a localhost
```
127.0.0.1/saroboot/api/login
```
If your route is a get method, you can ignore the last parameter in the add function statically called from Route class

### Controllers
To be able to communicate with the model and send back data to view, created a controller controller inside ```App/Controllers``` folder.  and registered the controller using spl_autoload_register() in the folder App/Config/loader.php


## Testing

To run unit test, do the following.

``` bash
vendor/bin/phpunit
```


### Security

If you discover any security related issues, please email angwamoses@gmail.com instead of using the issue tracker.

## Credits

- [Angwa Moses](https://github.com/angwa)


## License

The MIT License (MIT).


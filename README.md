Symfony Movie Application - WRA506
========================

The "Symfony Movie Application" is a class project application aimed at creating an API using APIPlatform to manage a list of films and actors. This project will streamline the process of storing, retrieving, updating, and deleting movie and actor information through a RESTful API interface.

Requirements
------------

  * PHP 8.1.0 or higher;

Installation
------------

[Download Composer][6] and use the `composer` binary installed
on your computer to run these commands:

```bash
# you can clone the code repository and install its dependencies
git clone https://github.com/Thibault-lvrn/WRA506.git movie_project
cd movie_project/
composer install
```

After your composer install, you have to update your .env file with your BDD information and your lexit/jwt-authentication-token.


```bash
# generate your JWT keypare
cd movie_project/
php bin/console lexik:jwt:generate-keypair
```

and add this in your .env file :

```bash
###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=
###< lexik/jwt-authentication-bundle ###
```

You can now generate you BDD and you data.

```bash
# create your database based on your entity
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

```bash
# update your data with fixtures
php bin/console doctrine:fixtures:load
```



Usage
-----

You have now access to your API url.

```
[your url]/movie_project/index.php/api
```

You can use this API to fetch all your database data, utilizing GET, POST, PUT, DELETE, and PATCH methods.
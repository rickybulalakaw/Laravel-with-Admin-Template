# Free Tailwind & Laravel admin dashboard template updated to Laravel 10

This is a fork of [Mosaic Lite Travel] (https://github.com/cruip/laravel-tailwindcss-admin-dashboard-template)

## Deployment Details 

The system uses Laravel's Sail package. Thus, the production host should have Docker Engine installed. 

_The repository includes PHPMYADMIN and MAILPIT containers for development. Make sure to make the appropriate changes in docker-compose.yml and .env file, as applicable, for development and production._ 

## Instructions for Installation
1. Make sure you have Docker running.  
2. Clone the repository in your machine.

Depending on your operating system, you may need to change ownership and access rights of files in your folder to allow write.

3. Go to the project folder. 
4. Copy the env.example file to .env 

```
cp .env.example .env
```

5. Make adjustments to your .env file, such as the name of the database and the username and password to access it. 
6. Install Laravel Sail
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
composer update --ignore-platform-reqs
``` 

then 

```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
php artisan sail:install
```

7. Run the containers.
8. Generate application key: 

```
sail artisan key:generate
```

9. Run migration 

```
sail artisan migrate
```

10. Install NPM packages 

```
sail npm install
```

```
sail npm run build
``` 

or 

```
sail npm run build -- --watch
```
_The "watch" switch will make the "build" run interactively so that any new classes you create will be re-built._

11. Remove excess code, such as extra controllers, migration files, and models.

12. Delete the .git folder.  
_This steps is needed to remove previous repository history as you will create a new repository for your own project._

```
sudo rm -R .git
```


13. Create your own .git repository for pushing to Github or other GIT Server.

```
git init
```

```
git add . 
```
_Take note of the period at the end which means add everything from this directory and its sub-directories._


```
git commit -m "initial commit"
```

14. Create online repository and follow instructions for pushing local repository. 
15. Build your own code! 


![Mosaic TailwindCSS template preview](https://github.com/cruip/laravel-tailwindcss-admin-dashboard-template/assets/2683512/9d256a65-3b8a-4c15-8a4a-865be9fa9a11)

**Mosaic Lite Laravel** is a responsive admin dashboard template built on top of Tailwind CSS and fully coded in Laravel Jetstream. This template is a great starting point for anyone who wants to create a user interface for SaaS products, administrator dashboards, modern web apps, and more.
Use it for whatever you want, and be sure to reach us out on [Twitter](https://twitter.com/Cruip_com) if you build anything cool/useful with it.

Created and maintained with ❤️ by [Cruip.com](https://cruip.com/).

## Live demo

Check a live demo here 👉️ [https://mosaic.cruip.com/](https://mosaic.cruip.com/?template=laravel)

## Mosaic Pro

[![Mosaic Pro](https://user-images.githubusercontent.com/2683512/151177961-2ff5b838-3745-48dc-80c8-80b043971483.png)](https://cruip.com/mosaic/)

## Design files

If you need the design files, you can download them from Figma's Community 👉 https://bit.ly/3sigqHe

## Table of contents

* [Usage](#usage)
  * [Setup your .env config file](#setup-your-env-config-file)
  * [Install Laravel dependencies](#install-laravel-dependencies)
  * [Migrate the tables](#migrate-the-tables)
  * [Generate some test data](#generate-some-test-data)
  * [Compile the front-end](#compile-the-front-end)
  * [Launch the Laravel backend](#launch-the-Laravel-backend)        
* [Credits](#credits)
* [Terms and License](#terms-and-license)
* [About Us](#about-us)
* [Stay in the loop](#stay-in-the-loop)

## Usage

This project was built with [Laravel Jetstream](https://jetstream.laravel.com/) and [Livewire + Blade](https://jetstream.laravel.com/2.x/introduction.html#livewire-blade) as Stack.

### Setup your .env config file
Make sure to add the database configuration in your .env file such as database name, username, password and port.

### Install Laravel dependencies
In the root of your Laravel application, run the ``php composer.phar install`` (or ``composer install``) command to install all of the framework's dependencies.

### Migrate the tables

In order to migrate the tables and setup the bare minimum structure for this app
to display some data you shoud open your terminal, locate and enter this project
directory and run the following command

``php artisan migrate``

### Generate some test data

Once you have all your database tables setup you can then generate some test data
which will come from our pre-made database table seeders.
In order to do so, in your terminal run the following command

``php artisan db:seed``

N.B. If you run this command twice, all the test data will be duplicated and added to the existing table data, if you want to avoid having duplicate test data please
make sure to ``truncate`` the following ``datafeeds`` table in your database.

### Compile the front-end

In order to compile all the CSS and JS assets for the front-end of this site you need to install NPM dependencies. To do that, open the terminal, type npm install and press the ``Enter`` key.

Then run ``npm run dev`` in the terminal to run a development server to re-compile static assets when making changes to the template.

When you have done with changes, run ``npm run build`` for compiling and minify for production.

### Launch the Laravel backend

In order to make this Laravel installation work properly on your local machine you
can run the following command in your terminal window.

``php artisan serve``

You should receive a message similar to this
``Starting Laravel development server: http://127.0.0.1:8000`` simply copy the URL
in your browser and you'll be ready to test out your new mosaic laravel app.


## Credits

- [Nucleo](https://nucleoapp.com/)

## Terms and License

- License 👉 [https://cruip.com/terms/](https://cruip.com/terms/).
- Copyright 2022 [Cruip](https://cruip.com/).
- Use it for personal and commercial projects, but please don’t republish, redistribute, or resell the template.
- Attribution is not required, although it is really appreciated.

## About Us

We're an Italian developer/designer duo creating high-quality design/code resources for developers, makers, and startups.

## Stay in the loop

If you would like to know when we release new resources, you can follow us on [Twitter](https://twitter.com/Cruip_com), or you can subscribe to our monthly [newsletter](https://cruip.com/#subscribe).

## APP




## Important commands

php artisan cache:clear;php artisan route:cache

php artisan migrate:refresh; php artisan db:seed


brew services restart php;brew services start mysql;php artisan serve  

php artisan sync:sites

php artisan translations:update



                          
npm run build          

cd /Users/beatgurtner/app/gruebe-luege-web
cd /Users/beatgurtner/app/gruebe-luege-web;php artisan serve        

php artisan db:seed
php artisan db:seed --class=CountriesSeeder
php artisan db:seed --class=ConstructionSiteSeeder


php artisan migrate:refresh
php artisan migrate --path=/database/migrations/2024_08_07_112314_create_machines_table.php


php artisan translations:update




php artisan make:controller PositionController  
php artisan make:model SkateSession  
php artisan make:migration Skateparks
php artisan db:seed --class=TrickLogSeeder

# SSH Zugang

./clear_cache.sh
ssh domatuku@domatuku.ssh.cloud.hostpoint.ch
cd ./www/baustellen.domatuku.myhostpoint.ch/

php artisan cache:clear;php artisan route:cache
composer install --optimize-autoloader



## Links

- Template: https://github.com/cruip/laravel-tailwindcss-admin-dashboard-template
- Icons: https://icons.getbootstrap.com/
- https://lokalise.com/blog/laravel-localization-step-by-step/
- Tooltip:
 - https://codepen.io/cristina-silva/pen/XXOpga
- Push:
 - https://www.iankumu.com/blog/laravel-firebase-push-notification/
 - Guides: http://ejulianova.github.io/guides/#docs


# How to seed:
delete all tables
php artisan migrate:refresh
import parks & cities
php artisan db:seed



## How to import skateparks

- Get data from https://app.outscraper.com/tasks
- Delete not needed cols
- Convert file with https://www.convertcsv.com/csv-to-csv.htm


# How to upload to Hostpoint

On mac terminal run:

npm run build

sync all files! CAVE: do not delete files


Upload all folder except for vendor

online run:

ssh domatuku@domatuku.ssh.cloud.hostpoint.ch
cd ./www/baustellen.domatuku.myhostpoint.ch/

if needed run:
composer install --optimize-autoloader



php artisan cache:clear;php artisan route:cache 


if images are missing, try:
php artisan cache:clear;php artisan route:cache 


if DB changed:
php artisan migrate:refresh; php artisan db:seed


only strucutre:
php artisan migrate


php artisan storage:link



DEBUG:

if error 500, make sure it's php8.1
if manifest error, check if all files are uploaded
php artisan cache:clear 
its being set via .htaccess!


if file upload of video is not working check php.ini






# Free Tailwind & Laravel admin dashboard template

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

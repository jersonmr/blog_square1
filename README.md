# Blog Square 1
---
[TOC]

This is a project done with Laravel framework and Tailwindcss framework using both technologies to get a result fit to the necessities.

Also, for this develop was used the official login package provided by Laravel called [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze), this includes all the scaffolding to do the login and register process.

## Steps to install the project correctly
Open the terminal and located inside the project folder, follow the next instructions:

1. Run the command `composer install`
2. Run the command `cp .env.example .env` to generate the `.env` file
3. Run the command `php artisan key:generate` to apply an **APP_KEY** into the `.env` file
4. Edit the `.env` file and modify with your own setting the vars:
    * DB_CONNECTION
    * DB_HOST
    * DB_PORT
    * DB_DATABASE
    * DB_USERNAME
    * DB_PASSWORD
5. Once the detabase is configured, locate the terminal in the folder project and run the command `php artisan migrate` to create the tables of the database
6. Run the command `php artisan db:seed` to create an admin user
7. After that, run the command `php artisan serve`
8. Open the browser and put write in the url search bar `http://127.0.0.1:8000/` to execute the project

## Very important!
To populate the database with the posts from the [API](https://sq1-api-test.herokuapp.com/posts) is necessary open other terminal and run the command `php artisan schedule:work`

For develop purpose, I recommend to change the time of execution of this task from every hour to every minute. To do this, just go to the file `kernel.php` located in `app/Console/Kernel.php` and modify the **line 43** changing the method `hourly()` by the method `everyMinute()`.

This way, the database will be populated with new records coming from the API every minute instead every hour.

This command execute a request to the API and save the records got in our database associated to the 'admin' user.

<u>**Recommendation:**</u> if this project will go to be executed in a production server I recommend install in the server a process watcher like **Supervisor** and configurate the schedule task through this.

You can follow the doc provided by Laravel to do it.
[How to config Supervisor](https://laravel.com/docs/8.x/queues#supervisor-configuration)

## Access like admin
```
email: admin@mail.test
password: password
```

**Done with love ❤**

# cmc-essentials
A CMC e-learning platform.


CMC-Essentials is a Laravel based framework, created for fast development of a "short" e-learning and quiz platform.
It was originally created for developing a Computer Mediated Communication learning platform, but it can be used to develop an e-learning platform with just about any content on any subject.

## Instalation and setup

### Requirements
* You need `Laravel version 5.2` installed. [Check the Laravel documentation for installation instructions](https://laravel.com/docs/5.2)
* Your also need `git` installed to work with the source code, this should be pretty obvious.

### Installation
* Clone the master branch of this project on your local computer or server:
`git clone `
* Do a composer install in the project directory
NOTE: The adminstartion dashboard of the application requires tinymce for rich text editing. This dependency has a bug, and you need to comment out the first line of code in the config file at `[installation_directory]/config/tinymce.php`
* Setup your MySQL database, make a copy of the .env.example file in your project root directory and name it .env ; edit the .env file with your database credentials.
* Run `php artisan migrate` in the project root directory. This will create the required database tables.
* Start your webserver and visit the route of your application.
You will see the Welcome page with some content from the original project. Plese follow the next steps to edit/change the default content and start adding your own teaching units and quizzes.

### Setup (Next Steps)
Using your favorite editor or IDE, edit the following blade template files.
* Custom welcome page.
  
    `[laravel_root_directory]/resources/views/welcome.blade.php`


* Custom Syllabus page.

    `[laravel_root_directory]/resources/views/syllabus.blade.php`


* Custom Session login page.

    `[laravel_root_directory]/resources/views/sessionLogin.blade.php`

__The Beauty of the application, Creating your own teaching units and quizzes from the dashboard. Couldn't be simpler__:
* Visit the page `[base_url]/auth/register` create a user account, then login at `[base_url]/auth/login`
* You will now see a button on the dashboard which allows you to create teaching units.
* After creating a teaching unit, you can click on the teaching unit and you will be able to create study content and quizzes for that teaching unit.

## Source code documentation
The source code documentation can be found at [CMC-Essentials docs](http://msem-rc.clappi.de/docs).

## Demo
A Demo of the application, created by the students who started this project can be found at [CMC-Essentials](http://msem-rc.clappi.de).

# sepwebdev
web development portfolio site with custom CMS, online [here](https://sepweb.dev).

dependencies
----------
-Php 8.2+

-Laravel 11

-npm

-Composer

setup
----------
1) set up a local server using something like [Xampp](https://www.apachefriends.org/download.html)
2) start the local server. In Xampp, this is done by pressing the start buttons for Apache and MySQL.
3) clone the repository to a folder within your localhost directory. (In the case of Xampp, probably c:/xampp/htdocs)
4) Go to the new directory: `cd sepwebdev`.
5) with [Composer](https://getcomposer.org/download/) installed, run the command `composer install`.
6) copy `.env.example` and rename it to `.env`.
7) run: `php artisan key:generate`. The key will appear in your .env file's `APP_KEY` field.
8) run php artisan migrate to create needed tables.
9) Optionally, if you want to use some default posts, open phpadmin (eg. xampp>mysql>config), go to the sepwebdev database, drop all the tables and import sepwebdev.sql, included in the root of this repository.
10) run `php artisan serve` and you can view the website at the provided link.
11) For hot asset updates, run `npm i` followed by `npm run dev`.

usage
----------
From the admin portal link at the bottom of the page, you can use the cms to make or edit posts, which will appear in the 'projects' section of the home page.

To make a user who can add, edit posts, go to the project root directory, in your terminal, run:
```
php artisan tinker

$user = new App\Models\User;
$user->name = 'John Doe';
$user->email = 'john@example.com';
$user->password = bcrypt('password');
$user->save();
```

Nb: This project was developed for a server with no symbolic link capabilities, so it works without symbolic links.

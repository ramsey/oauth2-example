# Mastering OAuth 2.0 Example Application

This is the full source code for the example application used in the "Mastering OAuth 2.0" talk for [Day Camp 4 Developers: PHPAppSec](https://daycamp4developers.com/previous-meetings/phpappsec/).

This is a [Laravel](https://laravel.com/) application that uses [Instagram](https://www.instagram.com/) to illustrate [OAuth 2.0](http://oauth.net/2/) concepts.

## Set Up

To run this application, open your favorite console application and run the following commands. If you haven't yet installed [Composer](https://getcomposer.org/), you'll need to install it first.

``` bash
git clone https://github.com/ramsey/oauth2-example.git
cd oauth2-example/
git checkout dc4d
composer install
cp .env.example .env
touch database/database.sqlite
sed -i "s@DB_DATABASE=sqlitedb@DB_DATABASE="$PWD"/database/database.sqlite@" .env
php artisan key:generate
php artisan migrate
```

Go to <https://instagram.com/> to create an Instagram account and then to <https://instagram.com/developer/clients/register/> to sign up as a developer and register an Instagram client. One of your “Valid redirect URIs” must be the value:

    http://localhost:8000/instagram

Edit `.env` and modify the following values, according to the ones received from Instagram:

    INSTAGRAM_CLIENT_ID=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    INSTAGRAM_CLIENT_SECRET=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

## Run the Application

After setting everything up, run the application:

``` bash
php artisan serve
```

Then, in your web browser, go to <http://localhost:8000/register> and register for an account. Afterwards, go to <http://localhost:8000/home> and click the “Click here to authorize with Instagram” link. This will walk you through the Instagram OAuth 2.0 flow.

## How It Works

Check out the "Mastering OAuth 2.0" chapter in _[Web Security 2016](https://www.phparch.com/books/web-security-2016/)_ from [php\[architect\] magazine](https://www.phparch.com/) for more details on OAuth 2.0 and this example application. I also recommend reading Matthew Frost's [_Integrating Web Services with OAuth and PHP_](https://www.phparch.com/books/integrating-web-services-with-oauth-and-php/).

The most important files in this application to review as examples are `app/Http/Controllers/HomeController.php` and `resources/views/home.blade.php`.

Also, please refer to the following projects for more information on OAuth 2.0:

* [league/oauth2-client](https://github.com/thephpleague/oauth2-client)
* [league/oauth2-instagram](https://github.com/thephpleague/oauth2-instagram)
* [ramsey/laravel-oauth2-instagram](https://github.com/ramsey/laravel-oauth2-instagram)

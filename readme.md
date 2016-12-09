# Mastering OAuth 2.0 Example Application

This is the full source code for the example application used in the ["Dominando OAuth 2.0" (Portuguese translation) article on iMasters](http://imasters.com.br/infra/seguranca/dominando-oauth-2-0/), December 9, 2016.

This is a [Laravel](https://laravel.com/) application that uses [Instagram](https://www.instagram.com/) to illustrate [OAuth 2.0](http://oauth.net/2/) concepts.

## Set Up

To run this application, open your favorite console application and run the following commands. If you haven't yet installed [Composer](https://getcomposer.org/), you'll need to install it first.

``` bash
git clone https://github.com/ramsey/oauth2-example.git
cd oauth2-example/
git checkout imasters
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

Check out ["Dominando OAuth 2.0" (Portuguese translation) on iMasters](http://imasters.com.br/infra/seguranca/dominando-oauth-2-0/) for more details on OAuth 2.0 and this example application.

The most important files in this application to review as examples are `app/Http/Controllers/HomeController.php` and `resources/views/home.blade.php`.

Also, please refer to the following projects for more information on OAuth 2.0:

* [league/oauth2-client](https://github.com/thephpleague/oauth2-client)
* [league/oauth2-instagram](https://github.com/thephpleague/oauth2-instagram)
* [ramsey/laravel-oauth2-instagram](https://github.com/ramsey/laravel-oauth2-instagram)

# Instagram OAuth 2.0 Example

## Set Up

``` bash
git clone https://github.com/ramsey/oauth2-phparch.git
cd oauth2-phparch/
cp .env.example .env
```

Go to <https://instagram.com/> to create an Instagram account and then to <https://instagram.com/developer/clients/register/> to sign up as a developer and register an Instagram client. One of your “Valid redirect URIs” must be the value `http://localhost:8000/instagram`.

Edit .env and modify the following values, according to the ones received from Instagram:

```
INSTAGRAM_CLIENT_ID=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
INSTAGRAM_CLIENT_SECRET=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

## Run the Application

After setting everything up, run the application:

``` bash
php -S localhost:8000 server.php
```

Then, in your web browser, go to <http://localhost:8000/register> and register for an account. Afterwards, go to <http://localhost:8000/home> and click the “Click here to authorize with Instagram” link. This will walk you through the Instagram OAuth 2.0 flow.

## How It Works

To see how it works, take a look at the source code in app/Http/Controllers/HomeController.php and resources/views/home.blade.php.

Also, refer to the following projects:

* [league/oauth2-client](https://github.com/thephpleague/oauth2-client)
* [league/oauth2-instagram](https://github.com/thephpleague/oauth2-instagram)
* [ramsey/laravel-oauth2-instagram](https://github.com/ramsey/laravel-oauth2-instagram)
